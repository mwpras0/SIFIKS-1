<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'pharmacist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'profile_picture', 'email', 'password'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->hasMany('App\Articles');
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function detail()
//    {
//        return $this->hasMany('App\DoctorDetail');
//    }


    /**
     * @param $str
     * @return string
     */
    public function trimStr($str)
    {
        if(strlen($str) > 20) {
            return substr($str, 0, 20)."...";
        }
        return $str;
    }

    /**
     * @return string
     */
    public function getGreetings()
    {
        $h = Carbon::now()->format('H');

        if ($h >= 0 && $h < 6) {
            return "<i class='fa far fa-surprise fa-2x'></i>&nbsp;&nbsp;Wow, ini masih pagi loh ";
        } elseif ($h >= 6 && $h < 11) {
            return "<i class='fa far fa-laugh-beam fa-2x'></i>&nbsp;&nbsp;Selamat pagi ";
        } elseif ($h >= 11 && $h <= 14) {
            return "<i class='fa far fa-smile-wink fa-2x'></i>&nbsp;&nbsp;Selamat siang ";
        } elseif ($h > 14 && $h <= 16) {
            return "<i class='fa far fa-smile-beam fa-2x'></i>&nbsp;&nbsp;Selamat sore ";
        } elseif ($h >= 17 && $h < 20) {
            return "<i class='fa far fa-grin-stars fa-2x'></i>&nbsp;&nbsp;Senja yang indah ya ";
        } else {
            return "<i class='fa far fa-bed fa-2x'></i>&nbsp;&nbsp;Sudah malam, sebaiknya kamu istirahat ";
        }
    }
}
