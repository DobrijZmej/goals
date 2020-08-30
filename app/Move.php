<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $fillable = [
        'goal_id',
        'date',
        'amount',
        'description',
      ];
    public function goal() {
        return $this->belongsTo('App\goal');
    }
}
