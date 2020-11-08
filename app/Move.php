<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function moveList($inUser){
        $moves = DB::select(DB::raw('SELECT   m.id,
        m.date,
        m.amount,
        m.description,
        g.name goal_name
FROM		goals g
        INNER JOIN moves m ON m.goal_id=g.id
WHERE		g.user_id=:user_id
ORDER BY m.date desc'), ['user_id'=>$inUser]);
        return $moves;
    }

}
