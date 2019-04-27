<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function country()
    {
        return $this->belongsTo(Country::class);
    }

     public function websites()
    {
        return $this->hasMany(Website::class);
    }
     public function fundings()
    {
        return $this->hasMany(Funding::class);
    }
     public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }
     public function emails()
    {
        return $this->hasMany(Email::class);
    }
     public function bio_infos()
    {
        return $this->hasMany(Bio_info::class);
    }
     public function works()
    {
        return $this->hasMany(Work::class);
    }
     public function peer_reviews()
    {
        return $this->hasMany(Peer_review::class);
    }
}
