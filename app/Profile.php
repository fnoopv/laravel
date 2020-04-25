<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $sex
 * @property int|null $age
 * @property string|null $birthday
 * @property string|null $url
 * @property string|null $phone
 * @property string|null $sign
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUserId($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    protected $fillable=['user_id','sex','age','birthday','url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
