@extends('layouts.app')

@section('head')
    <style>
        .form-control-input{
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <h1 align="center">Edit Source</h1>
    {!! Form::open(['action' => ['SourcesController@update', $source->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', $source->name, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/sources/{{$source->id}}">Back</a>
    {!! Form::close() !!}
@endsection