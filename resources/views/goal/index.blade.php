@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<style>
.col-sm-8{
    float:left;
}
.col-sm-3{
    float:right;
}
button .add-new {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--div-- class="panel-heading">{{ __('goals.list') }}<a href="/node/create" class="btn btn-success"> + Create</a></!--div-->
                <!-- template https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=table-with-add-and-delete-row-feature -->
                <div class="col-sm-8"><h2>{{ __('goals.list') }}</h2></div>
                    <div class="col-sm-3">
                    <a href="{{ route('goals.create') }}"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> {{ __('goals.add') }}</button></a>
                    </div>
                <div class="panel-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{{ __('goals.name') }}</th>
                            <th>{{ __('goals.description') }}</th>
                            <th>{{ __('goals.target_amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goals as $goal)
                            <tr>
                                <td>{{ $goal->id }}</td>
                                <td>{{ $goal->title }}</td>
                                <td>{{ $goal->type }}</td>
                                <td style="text-align:right;">
                                    <a href="/node/{{ $goal->id }}" class="btn btn-info">View</a>
                                    <a href="/node/{{ $goal->id }}/edit" class="btn btn-success">Edit</a>
                                    <a href="/node/{{ $goal->id }}/destroy" class="btn btn-danger">Dellete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>@endsection
