<?php

namespace App\Http\Controllers;

use App\goal;
use App\User;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $goals = $user->goals()->orderBy('id', 'desc')->paginate(10);
        return view('goal.index')->with('goals', $goals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, goal $goal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(goal $goal)
    {
        //
    }
}
