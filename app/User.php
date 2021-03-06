<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'biography', 'profile_picture', 'email', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function thread() {
        return $this->hasMany('App\Thread', 'user_id');
    }

    /**
     * @return int
     */
    public function threadAnswered() {
        return count(
            Thread::where('status', true)
                ->where('user_id', Auth::guard('web')
                ->user()->id)
                ->get()
        );
    }

    /**
     * @param string $str
     * @return string
     */
    public function trimStr(string $str)
    {
        if(strlen($str) > 50) {
            return substr($str, '0', '50')."...";
        }
        return $str;
    }
}
