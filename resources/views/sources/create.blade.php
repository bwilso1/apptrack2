@extends('layouts.app')

@section('head')
    <style>
        .form-control-input{
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <h1 align="center">Add Source</h1>
    {!! Form::open(['action' => 'SourcesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/sources">Back</a>
    {!! Form::close() !!}
@endsection