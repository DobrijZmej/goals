<?php

namespace App\Http\Controllers;

use App\Moves;
use App\goal;
//use Illuminate\Http\Request;
use Request;

class MovesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        //dd($user->moves()->get());
        $moves = $user->moves()->orderBy('id', 'desc')->paginate(10);
        //$goals = $user->goals()->orderBy('id', 'desc')->paginate(10);
        //$data = ["goals"=>$goals, "moves"=>$moves];
        //dd($moves);
        return view('moves.index')->with('moves', $moves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $goals = $user->goals()->orderBy('id', 'desc')->paginate(10);
        return view('moves.create')->with('goals', $goals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Request::all();
        //$input = array_merge($input, ['user_id' => auth()->user()->id]);
        //dd($input);
        //$input->user_id = auth()->user()->id;
        moves::create($input);

        return redirect('moves');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function show(Moves $moves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function edit(Moves $moves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moves $moves)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moves $moves)
    {
        //
    }
}
