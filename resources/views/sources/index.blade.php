@extends('layouts.app')

@section('content')
    <h1 align="center">Sources</h1> <br>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Entered On</th>
            </tr>
        </thead>
        <tbody>
        @if(count($sources) > 0)
            @foreach($sources as $source)
                <tr>
                    <td><a href="/sources/{{$source->id}}">{{$source->id}}</a></td>
                    <td>{{$source->source_name}}</td>
                    <td>{{$source->created_at}}</td>
                </tr>
            @endforeach
        @else
            <p>No Sources found</p>
        @endif
        </tbody>
    </table> <br>
    <a class="btn btn-primary" href="/sources/create">Add Source</a>
@endsection