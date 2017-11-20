@extends('layouts.app')

@section('head')
    <style>
        .form-control-dropdown 
        {
            width: auto;
        }
        .form-control-input{
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <h1 align="center">Edit Job</h1>
    {!! Form::open(['action' => ['JobsController@update', $job->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('job_title', 'Job Title:')}}
            {{Form::text('job_title', $job->job_title, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/jobs/{{$job->id}}">Back</a>
    {!! Form::close() !!}
@endsection