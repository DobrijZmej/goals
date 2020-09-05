<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function goals() {
        return $this->hasMany('App\goal');
    }

    public function moves() {
        return $this->hasMany('App\goal')->join('moves', 'moves.goal_id', '=', 'goals.id')->select('moves.*');
        //return $this->hasManyThrough('App\Moves', 'App\goal', 'id', 'goal_id', 'id');
    }

    public function chartLines() {
        return $this->hasMany('App\goal')->join('moves', 'moves.goal_id', '=', 'goals.id')->select('goals.id', 'goals.name', 'moves.date', 'moves.amount');
        //return $this->hasManyThrough('App\Moves', 'App\goal', 'id', 'goal_id', 'id');
    }

}
