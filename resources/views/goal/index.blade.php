@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('goals.list') }}<a href="/node/create" class="btn btn-success"> + Create</a></div>
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
