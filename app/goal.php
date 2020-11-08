<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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
    public function chartGoals($in_user_id) {
        $goals = DB::table('goals')
                    ->select(DB::raw('goals.id,
                    goals.name,
                    goals.currency,
                    goals.amount_target,
                    (SELECT MIN(m.date) FROM moves m WHERE m.goal_id=goals.id) min_date,
                    (SELECT MAX(m.date) FROM moves m WHERE m.goal_id=goals.id) max_date'))
                    ->where('user_id', '=', $in_user_id);
        $goals = DB::select(DB::raw('select goals.id,
        goals.name,
        goals.currency,
        goals.amount_target,
        (SELECT MIN(m.date) FROM moves m WHERE m.goal_id=goals.id) min_date,
        (SELECT MAX(m.date) FROM moves m WHERE m.goal_id=goals.id) max_date
        from goals
        where user_id=:user_id'), ['user_id'=>1]);
        return $goals;
    }

    public function goalList($inUser){
        $goals = DB::select(DB::raw('select g.id,
        g.name,
        curr.name currency,
        g.amount_target,
        g.description,
        ifnull((select sum(amount) from moves m where m.goal_id=g.id), 0) current_amount
        from goals g
             left join currency curr on curr.id=g.currency
        where g.user_id=:user_id
        order by 1'), ['user_id'=>$inUser]);
        return $goals;
    }
}
