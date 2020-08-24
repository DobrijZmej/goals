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
}
