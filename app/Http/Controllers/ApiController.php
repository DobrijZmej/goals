<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getChartLines()
    {
        $user = auth()->user();
        $goals = $user->goals()->orderBy('id', 'desc')->get();
        //$goals = $user->chartLines()->orderBy('id', 'desc')->get();
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
        return response()->json($result);
    }
}
