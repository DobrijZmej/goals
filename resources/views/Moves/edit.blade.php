@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

<div class='col-md-6 col-md-offset-3'>
  <h1>{{ __('moves.edit_move') }}</h1>
<hr>

<form action="
        @if(!$move->read_only)
            {{ route('moves.update', $move) }}
        @else
            {{ route('moves.index') }}
        @endif
" method="POST">
@csrf
@if(!$move->read_only)
    @method("PUT")
@else
    @method("GET")
@endif

<div class="input-group mb-3"><div class="input-group-prepend">
    <label class="input-group-text" for="goalsList">{{ __('moves.form_goals_list') }}</label>
  </div>
  @if(!$move->read_only)
    <select class="custom-select" id="goalsList" name="goal_id" autofocus>
        <option selected>{{ __('moves.form_goals_list_select') }}</option>
        @foreach($goals as $goal)
        <option value="{{ $goal->id }}"
        @if($goal->id == $move->goal_id)
            selected
        @endif
        >{{ $goal->name }}</option>
        @endforeach
    </select>
  @else
    @foreach($goals as $goal)
       @if($goal->id == $move->goal_id)
        <input type="text" class="form-control" value="{{ $goal->name }}" {{ $move->read_only }}>
       @endif
    @endforeach
  @endif
</div>

<div class="input-group mb-3"><div class="input-group-prepend">
    <label class="input-group-text" for="moveDate">{{ __('moves.form_date') }}</label></div>
    <input type="date" class="form-control" id="moveDate" name="date" aria-describedby="goalNameHelp" placeholder="{{ __('moves.form_date_hint') }}" value="{{ date('Y-m-d', strtotime($move->date)) }}" {{ $move->read_only }}>
</div>

<div class="input-group mb-3"><div class="input-group-prepend">
    <span class="input-group-text">{{ __('moves.form_amount') }}</span></div>
    <input type="number" class="form-control" id="moveAmount" name="amount" step="any" min="0" placeholder="{{ __('moves.form_amount') }}" value="{{ $move->amount }}" {{ $move->read_only }}>
</div>

<div class="input-group mb-3"><div class="input-group-prepend">
    <span class="input-group-text">{{ __('moves.form_description') }}</span></div>
    <input type="text" class="form-control" id="moveDescription" name="description" placeholder="{{ __('moves.form_description_hint') }}" value="{{ $move->description }}" {{ $move->read_only }}>
</div>


  <button type="submit" class="btn btn-primary">
        @if(!$move->read_only)
            {{ __('moves.form_create') }}
        @else
            {{ __('moves.form_back') }}
        @endif
        </button>
</form>
 </div>
 </div>
</div>
@stop
