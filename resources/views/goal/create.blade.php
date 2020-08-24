@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

<div class='col-md-6 col-md-offset-3'>
  <h1>{{ __('goals.Create new goal') }}</h1>
<hr>

<form action="{{ route('goals.store') }}" method="POST">
@csrf

  <div class="form-group">
    <label for="goalName">{{ __('goals.form_name') }}</label>
    <input type="text" class="form-control" id="goalName" name="name" aria-describedby="goalNameHelp" placeholder="{{ __('goals.form_name_hint') }}">
    <!-- <small id="goalNamelHelp" class="form-text text-muted">{{ __('goals.form_name_description') }}</small> -->
  </div>

  <div class="form-group">
    <label for="goalDescription">{{ __('goals.form_description') }}</label>
    <input type="text" class="form-control" id="goalDescription" name="description" placeholder="{{ __('goals.form_description_hint') }}">
  </div>

  <div class="form-group">
    <label for="goalCurency">{{ __('goals.form_currency') }}</label>
    <input type="text" class="form-control" id="goalCurency" name="currency" placeholder="{{ __('goals.form_currency_hint') }}">
  </div>

  <div class="form-group">
    <label for="goalAmount">{{ __('goals.form_amount') }}</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        <input type="number" class="form-control" id="goalAmount" name="amount_target" step="any" min="0" placeholder="{{ __('goals.form_amount') }}">
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
 </div>
 </div>
</div>
@stop
