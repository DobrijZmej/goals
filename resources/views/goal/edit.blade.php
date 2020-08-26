@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

<div class='col-md-6 col-md-offset-3'>
  <h1>{{ __('goals.Edit goal') }}</h1>
<hr>

<form action="
        @if(!$goal->read_only)
            {{ route('goals.update', $goal) }}
        @else
            {{ route('goals.index') }}
        @endif
" method="POST">
@csrf
@if(!$goal->read_only)
    @method("PUT")
@else
    @method("GET")
@endif


  <div class="form-group">
    <label for="goalName">{{ __('goals.form_name') }}</label>
    <input type="text" class="form-control" id="goalName" name="name" aria-describedby="goalNameHelp" placeholder="{{ __('goals.form_name_hint') }}" value="{{ $goal->name }}" {{ $goal->read_only }}>
    <!-- <small id="goalNamelHelp" class="form-text text-muted">{{ __('goals.form_name_description') }}</small> -->
  </div>

  <div class="form-group">
    <label for="goalDescription">{{ __('goals.form_description') }}</label>
    <input type="text" class="form-control" id="goalDescription" name="description" placeholder="{{ __('goals.form_description_hint') }}" value="{{ $goal->description }}" {{ $goal->read_only }}>
  </div>

  <div class="form-group">
    <label for="goalCurency">{{ __('goals.form_currency') }}</label>
    <input type="text" class="form-control" id="goalCurency" name="currency" placeholder="{{ __('goals.form_currency_hint') }}" value="{{ $goal->currency }}" {{ $goal->read_only }}>
  </div>

  <div class="form-group">
    <label for="goalAmount">{{ __('goals.form_amount') }}</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        <input type="number" class="form-control" id="goalAmount" name="amount_target" step="any" min="0" placeholder="{{ __('goals.form_amount') }}" value="{{ $goal->amount_target }}" {{ $goal->read_only }}>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">
        @if(!$goal->read_only)
            {{ __('goals.form_update') }}
        @else
            {{ __('goals.form_back') }}
        @endif
        </button>
</form>
 </div>
 </div>
</div>
@stop
