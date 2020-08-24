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
.btn-sm {
    padding: 0.10rem;
    line-height: 1;
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
                            <th class="text-center">{{ __('goals.name') }}</th>
                            <th class="text-center">{{ __('goals.description') }}</th>
                            <th class="text-center">{{ __('goals.target_amount') }}</th>
                            <th class="text-center">{{ __('goals.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goals as $goal)
                            <tr>
                                <td>{{ $goal->name }}</td>
                                <td>{{ $goal->description }}</td>
                                <td>{{ $goal->amount_target }}</td>
                                <td style="text-align:right;">
                                    <a href="/goals/{{ $goal->id }}" class="btn btn-info btn-sm"><i class="material-icons">&#xE03B;</i></a>
                                    <a href="{{ route('goals.edit', $goal) }}" class="btn btn-success btn-sm"><i class="material-icons">&#xE254;</i></a>
                                    <a href="{{ route('goals.destroy.link', $goal->id) }}" class="btn btn-danger btn-sm"><i class="material-icons">&#xE872;</i></a>
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
