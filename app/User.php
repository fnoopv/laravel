<?php

namespace App;

use App\Mailer\UserMailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Naux\Mail\SendCloudTemplate;
use Mail;

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
