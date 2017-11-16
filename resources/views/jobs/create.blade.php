@extends('layouts.app')

@section('head')
    <style>
        .form-control-input{
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <h1 align="center">Add Job</h1>
    {!! Form::open(['action' => 'JobsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('job_title', 'Job Title:')}}
            {{Form::text('job_title', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/jobs">Back</a>
    {!! Form::close() !!}
@endsection