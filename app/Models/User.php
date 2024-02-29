<?php

namespace App\Models;

use App\Helpers\SiteHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['dob_formatted', 'picture_url', 'user_picture_url'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getDobFormattedAttribute()
    {
        return SiteHelper::reformatReadableDate($this->dob);
    }

    public function getPictureUrlAttribute()
    {
        if (!empty($this->picture)) {
            return asset('uploads/students'). '/' . $this->picture;
            // return asset('panel_assets/l.png');
//            return env('BASE_URL') . ('uploads/students/') . $this->picture;
        }
    }

    public function getUserPictureUrlAttribute()
    {
        if ($this->picture)
            return env('BASE_URL') . 'public/uploads/user/' . $this->picture;
        else
            return env('BASE_URL') . 'public/panel_assets/images/default.png';
    }

    public function user_session(){
        return $this->hasOne(UserSession::class);
    }
}
