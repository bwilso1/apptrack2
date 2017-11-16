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
    <h1>Add Question</h1>
    {!! Form::open(['action' => ['QuestionsController@update', $question->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('content', 'Content:')}}
            {{Form::textarea('content', $question->content, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('job_title', 'Job:')}}
            {{Form::select('job_title', $jobArray, $question->job_title, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('type', 'Type:')}}
            {{Form::select('type', 
            ['Interview' => 'Interview', 'Phone Screen' => 'Phone Screen'], $question->type, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/questions/{{$question->id}}">Back</a>
    {!! Form::close() !!}
@endsection