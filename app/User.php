<?php

namespace App;

use App\Mailer\UserMailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Naux\Mail\SendCloudTemplate;
use Mail;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $confirmation_token
 * @property int $is_active
 * @property int $questions_count
 * @property-read int|null $answers_count
 * @property int $comments_count
 * @property-read int|null $favorites_count
 * @property int $likes_count
 * @property-read int|null $followers_count
 * @property int $followings_count
 * @property mixed|null $settings
 * @property string $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $favorites
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followersUser
 * @property-read int|null $followers_user_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $follows
 * @property-read int|null $follows_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Profile|null $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Topic[] $topics
 * @property-read int|null $topics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAnswersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFavoritesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFollowersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFollowingsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLikesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereQuestionsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','api_token'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * @param Model $model
     * @return bool
     */
    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }

    public function getQuestions($id)
    {
        return Question::where('user_id','=',$id)->get();
    }

    //声明关注者与被关注者关系
    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    public function followersUser()
    {
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    public function votes()
    {
        return $this->belongsToMany(Answer::class,'votes')->withTimestamps();
    }

    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }

    public function hasVotedFor($answer)
    {
        return !! $this->votes()->where('answer_id',$answer)->count();
    }

    public function follows()
    {
        return $this->belongsToMany(Question::class,'user_question')->withTimeStamps();
    }

    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    public function followed($question)
    {
        return !! $this->follows()->where('question_id',$question)->count();
    }

    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'to_user_id');
    }

    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class,'favorites','user_id','question_id')
                    ->withTimestamps();
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class,'favorite_topics')->withTimestamps();
    }
    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        (new UserMailer())->passwordReset($this->email,$token);
    }


    public function getQuestion($user)
    {
        $question = array_unique(Answer::where('user_id','=',$user)->pluck('question_id')->toArray());
        $questionId = array();
        foreach ($question as $key => $value)
        {
            array_push($questionId,$value);
        }
        $use = array();
        for ($i=0;$i< count($questionId);$i++)
        {
            array_push($use,Question::where('id','=',$questionId[$i])->get());
        }
        return $use;
    }

    public function getFollowings($user)
    {
        $user = User::find($user)->followersUser()->where('follower_id','=',$user)->pluck('followed_id');
        $users = array();
        for ($i=0;$i<count($user);$i++)
        {
            array_push($users,User::where('id','=',$user[$i])->get());
        }
        return $users;
    }

    public function getFollowers($user)
    {
        $user = User::find($user)->followersUser()->where('followed_id','=',$user)->pluck('follower_id');
        $users = array();
        for ($i=0;$i<count($user);$i++)
        {
            array_push($users,User::where('id','=',$user[$i])->get());
        }

        return $users;
    }

    public function getFavorites()
    {
        $user=Auth::id();
        $result = Favorite::where('user_id','=',$user)->pluck('question_id');
        $question = array();
        for ($i=0;$i<count($result);$i++)
        {
            array_push($question,Question::where('id','=',$result[$i])->get());
        }

        return $question;
    }
}
