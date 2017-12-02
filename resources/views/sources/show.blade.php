@extends('layouts.app')

@section('content')
    <h2><strong>Source Name:</strong> {{$source->name}}</h2>
    <h3><strong>Source ID:</strong> {{$source->id}}</h3> <br>
    <a class="btn btn-primary" href="/sources/{{$source->id}}/edit">Edit</a>
    <a class="btn btn-default" href="/sources">Back</a>
@endsection