<?php

namespace App\Http\Controllers;

use App\Move;
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
        //$moves = $user->moves()->orderBy('date', 'desc')->paginate(10);
        //return view('Moves.index')->with('moves', $moves);
        $moves = new Move();
        $moves = $moves->moveList($user->id);
        return view('Moves.index')->with('moves', $moves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $goals = $user->goals()->orderBy('name', 'desc')->paginate(10);
        return view('Moves.create')->with('goals', $goals);
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
        Move::create($input);

        return redirect('moves');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function show(Move $move)
    {
        $user = auth()->user();
        $goals = $user->goals()->orderBy('id', 'desc')->get();
        $move->read_only = "readonly";
        return view('Moves.edit')->with('goals', $goals)->with('move', $move);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function edit(Move $move)
    {
        $user = auth()->user();
        $goals = $user->goals()->orderBy('id', 'desc')->get();
        return view('Moves.edit')->with('goals', $goals)->with('move', $move);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Move $move)
    {
        $input = Request::all();
        $move->goal_id = $input['goal_id'];
        $move->date = $input['date'];
        $move->description = $input['description'];
        $move->amount = $input['amount'];
        $move->update();

        return redirect('moves');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function destroy(Move $move)
    {
        //dd($goal);
        $move->delete();

        return redirect(route('moves.index'));
    }
}
