@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

<div class='col-md-6 col-md-offset-3'>
  <h1>{{ __('moves.Create new goal') }}</h1>
<hr>

<form action="{{ route('moves.store') }}" method="POST">
@csrf

<div class="input-group mb-3"><div class="input-group-prepend">
    <label class="input-group-text" for="goalsList">{{ __('moves.form_goals_list') }}</label>
  </div>
  <select class="custom-select" id="goalsList" name="goal_id" autofocus>
    <option selected>{{ __('moves.form_goals_list_select') }}</option>
    @foreach($goals as $goal)
       <option value="{{ $goal->id }}">{{ $goal->name }}</option>
    @endforeach
  </select>
</div>

<div class="input-group mb-3"><div class="input-group-prepend">
    <label class="input-group-text" for="moveDate">{{ __('moves.form_date') }}</label>
  </div>
    <input type="date" class="form-control" id="moveDate" name="date" aria-describedby="goalNameHelp" placeholder="{{ __('moves.form_date_hint') }}" value="{{ date('Y-m-d') }}">
</div>

<div class="input-group mb-3"><div class="input-group-prepend">
    <span class="input-group-text">{{ __('moves.form_amount') }}</span></div>
    <input type="number" class="form-control" id="moveAmount" name="amount" step="any" min="-999999999" placeholder="{{ __('moves.form_amount') }}">
</div>

<div class="input-group mb-3"><div class="input-group-prepend">
    <span class="input-group-text">{{ __('moves.form_description') }}</span></div>
    <input type="text" class="form-control" id="moveDescription" name="description" placeholder="{{ __('moves.form_description_hint') }}">
</div>


  <button type="submit" class="btn btn-primary">{{ __('moves.form_create') }}</button>
</form>
 </div>
 </div>
</div>
@stop
