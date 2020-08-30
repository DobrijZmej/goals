@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">

<div class='col-md-6 col-md-offset-3'>
  <h1>{{ __('goals.Create new goal') }}</h1>
<hr>

<form action="{{ route('goals.store') }}" method="POST" id="f">
@csrf

  <div class="form-group">
    <label for="goalName">{{ __('goals.form_name') }}</label>
    <input type="text" class="form-control" id="goalName" name="name" aria-describedby="goalNameHelp" placeholder="{{ __('goals.form_name_hint') }}">
    <small id="goalNameError" class="form-text text-muted" style="opacity:0"></small>
    </div>

  <div class="form-group">
    <label for="goalDescription">{{ __('goals.form_description') }}</label>
    <input type="text" class="form-control" id="goalDescription" name="description" placeholder="{{ __('goals.form_description_hint') }}">
    <small id="goalDescriptionError" class="form-text text-muted" style="opacity:0"></small>
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

  <div class="input-group mb-3"><div class="input-group-prepend">
    <button type="submit" class="btn btn-primary">{{ __('goals.form_create') }}</button>
    <span id="submitLoading" class="input-group-text" style="opacity:0"><img src="/img/arrow_loading_002.gif" class="btn" style="width:2.5em;"></span></div>
</div>

</form>
 </div>
 </div>
</div>
<script>
function validate(){
    $("#f button").prop('disabled', true);
    $("#submitLoading").fadeTo(0, 1);
    var formData = $('#f').serializeArray();
    var jsonData = {};
    $.map(formData, function(n, i){
        jsonData[n['name']] = n['value'];
    });
    $.post("{{ route('goals.create.validate') }}", jsonData).done(function(restData){
        if(restData.name.checked){
            $('#goalNameError').animate({opacity:0}, 1);
        } else {
            $('#goalNameError').html(restData.name.error);
            $('#goalNameError').animate({opacity:1}, 1);
        }
        if(restData.description.checked){
            $('#goalDescriptionError').animate({opacity:0}, 1);
        } else {
            $('#goalDescriptionError').html(restData.name.error);
            $('#goalDescriptionError').animate({opacity:1}, 1);
        }
        console.log(restData.name);
        $("#f button").prop('disabled', false);
        $("#submitLoading").fadeTo("slow", 0);
    });
}
$("#f").submit(function(){
    console.log('onSubmit');
    validate();
    if($("small[style*='opacity:1']").length > 0){
        return false;
    }
    return true;
});
</script>
@stop
