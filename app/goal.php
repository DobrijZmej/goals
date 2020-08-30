<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class goal extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'currency',
        'amount_target',
      ];
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function moves() {
        return $this->hasMany('App\Moves');
    }
}
