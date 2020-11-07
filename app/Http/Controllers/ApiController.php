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

        /*Сначала определим диапазон - минимальную и максимальную даты по пользователю*/

        $q_dates = DB::select(DB::raw('
        select  DATE_FORMAT(MIN(m.date)-INTERVAL 1 DAY,"%d.%m.%Y %H:%i:%S") min_date,
                DATE_FORMAT(MAX(m.date)+INTERVAL 1 DAY,"%d.%m.%Y %H:%i:%S") max_date
        from    goals g
                inner join moves m on m.goal_id=g.id
        where   user_id=:user_id
        '), ['user_id'=>$user->id]);

        foreach($q_dates as $row){
            $min_date = date_create_from_format("d.m.Y H:i:s", $row->min_date);
            $max_date = date_create_from_format("d.m.Y H:i:s", $row->max_date);
        }
           // посчитаем разницу между датами
        $date_diff = $max_date->getTimestamp() - $min_date->getTimestamp();
           // и поделим на 10 отрезков
        $interval = $date_diff/10;
        $dates = [];
        $curr_date = $min_date->getTimestamp();
        for ($i=0; $i <= 10; $i++) {
            $dates[] = date("d.m.Y H:i:s", $curr_date);
            $curr_date = $curr_date + $interval;
        }

           // теперь есть 11 точек на графике, нужно под каждую заполить остатки на целях
        //dd($dates);

        /*$result = (object)[];
        $result->min_date = $min_date;
        $result->max_date = $max_date;
        $result->date_diff = $date_diff;*/

           // выберем перечень целей
        $goals_list = DB::select(DB::raw('
           select  goals.id,
                   goals.name,
                   goals.currency,
                   goals.amount_target
           from    goals
           where   user_id=:user_id
           '), ['user_id'=>$user->id]);
        $goals_names = [];
        foreach($goals_list as $goal){
            $goals_names[] = $goal->name;
        }
        $goals_names[] = "Усього";
        $goals = [];
           // цикл по нашим датам
        foreach($dates as $date){
            $row = [];
            $row[] = $date;
            $total_amount = 0;
               // цикл по выбранным ранее целям
            foreach($goals_list as $goal){
                $goal_data = DB::select(DB::raw('
                select  ifnull((select sum(amount) from moves m where m.goal_id=goals.id and m.date <= STR_TO_DATE (:date, "%d.%m.%Y %H:%i:%S")), 0) amount
                from    goals
                where   goals.id=:goal_id
                '), ['goal_id'=>$goal->id, 'date'=>$date]);
                   // для каждой цели заполняем сумму накоплений на дату
                   foreach ($goal_data as $g_row) {
                    $row[] = floatval($g_row->amount);
                    $total_amount = $total_amount + floatval($g_row->amount); // плюс запоминаем общие накопления
                }
            }
            $row[] = $total_amount; // добавляем общие накопления
            $goals[]=$row;
        }
        $result = (object)[];
        $result->goals = $goals_names;
        $result->lines = $goals;
        return response()->json($result);

        $goals = DB::select(DB::raw('
        select  goals.id,
                goals.name,
                goals.currency,
                goals.amount_target
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

        return response()->json($result);
    }
}
