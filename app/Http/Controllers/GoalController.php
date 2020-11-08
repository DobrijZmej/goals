<?php

namespace App\Http\Controllers;

use App\goal;
use App\User;
use App\Currency;
//use Illuminate\Http\Request;
use Request;

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
        //$goals = $user->goals()->orderBy('id', 'desc')->paginate(10);
        $goals = new goal();
        $goals = $goals->goalList($user->id);
        return view('goal.index')->with('goals', $goals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = new Currency();
        //dd($currency->getActive());
        $curr = $currency->getActive();
        //->getActive();
        return view('goal.create')->with('currencies', $curr);
    }

    public function createValidate(Request $request)
    {
        $input = Request::all();
        $validate = (object)["checked"=>true, "error"=>""];
        $result = (object)["name"=>clone($validate), "description"=>clone($validate), "currency"=>clone($validate), "amount_target"=>clone($validate)];
        if($input["name"] == "") {
            $result->name->checked=false;
            $result->name->error=__('goals.errorNameEmpty');
        }
        return response()->json($result);
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
        $input = array_merge($input, ['user_id' => auth()->user()->id]);
        //dd($input);
        //$input->user_id = auth()->user()->id;
        goal::create($input);

        return redirect('goals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(goal $goal)
    {
        //dd($goal);
        $goal->read_only = "readonly";
        $currency = new Currency();
        $curr = $currency->getActive();
        return view('goal.edit', ['goal' => $goal, 'currencies' => $curr]);//->with('goal', $goal)->with('currencies', $curr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(goal $goal)
    {
        $currency = new Currency();
        $curr = $currency->getActive();
        return view('goal.edit', ['goal' => $goal, 'currencies' => $curr]);//->with('goal', $goal)->with('currencies', $curr);
        //return view('goal.edit')->with('goal', $goal);
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
        $input = Request::all();
        $goal->name = $input['name'];
        $goal->description = $input['description'];
        $goal->currency = $input['currency'];
        $goal->amount_target = $input['amount_target'];
        //dd($goal);
        //goal::update($goal);
        $goal->update();

        return redirect('goals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(goal $goal)
    {
        //dd($goal);
        $goal->delete();

        return redirect(route('goals.index'));
    }
}
