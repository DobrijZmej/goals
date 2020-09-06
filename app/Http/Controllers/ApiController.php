<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\goal;
use DB;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getChartLines()
    {
        $user = auth()->user();
        //$goals = $user->goals()->orderBy('id', 'desc')->get();
        //$goals = $user->chartLines()->orderBy('id', 'desc')->get();
        $goals = DB::select(DB::raw('
        select  goals.id,
                goals.name,
                goals.currency,
                goals.amount_target,
                (SELECT MIN(m.date) FROM moves m WHERE m.goal_id=goals.id) min_date,
                (SELECT MAX(m.date) FROM moves m WHERE m.goal_id=goals.id) max_date
        from    goals
        where   user_id=:user_id
        '), ['user_id'=>$user->id]);

        $result = (object)[];
        $data = $user->chartLines()->orderBy('date', 'asc')->get();
        $lines = [];
        $initAmount = 0;
        foreach($data as $row){
            $lines[] = [date("Y-m-d", strtotime($row['date'])), $initAmount + $row['amount']];
            $initAmount = $initAmount + $row['amount'];
            //dd($row);
        }
        $result->goals = $goals;
        $result->lines = $lines;
        //dd($goals);
        //dd
        //$goals2 = new goal();
        //$goals2->chartGoals($user->id);
        //dd($goals2);
        //return response()->json($goals2);
        return response()->json($result);
    }
}
