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
                <div class="col-sm-8"><h2>{{ __('moves.list') }}</h2></div>
                    <div class="col-sm-3">
                    <a href="{{ route('moves.create') }}"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> {{ __('moves.add') }}</button></a>
                    </div>
                <div class="panel-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">{{ __('moves.date') }}</th>
                            <th class="text-center">{{ __('moves.amount') }}</th>
                            <th class="text-center">{{ __('moves.description') }}</th>
                            <th class="text-center">{{ __('moves.action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($moves as $move)
                            <tr>
                                <td>{{ date("d.m.Y", strtotime($move->date)) }}</td>
                                <td>{{ $move->amount }}</td>
                                <td>{{ $move->description }}</td>
                                <td style="text-align:right;">
                                    <a href="{{ route('moves.show', $move) }}" class="btn btn-info btn-sm" title="{{ __("moves.hint_view") }}"><i class="material-icons">&#xE03B;</i></a>
                                    <a href="{{ route('moves.edit', $move) }}" class="btn btn-success btn-sm" title="{{ __("moves.hint_edit") }}"><i class="material-icons">&#xE254;</i></a>
                                    <a href="{{ route('moves.destroy.link', $move->id) }}" class="btn btn-danger btn-sm" title="{{ __("moves.hint_delete") }}"><i class="material-icons">&#xE872;</i></a>
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
