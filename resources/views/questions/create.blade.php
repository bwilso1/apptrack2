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
    <h1 align="center">Add Question</h1>
    {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('content', 'Content:')}}
            {{Form::textarea('content', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('job_title', 'Job:')}}
            <select class="form-control" name="job_title" style="width: auto;">
                <option value=''>-Select Job-</option>
                @foreach($jobs as $job)
                    <option value='{{$job->id}}'>{{$job->job_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('type', 'Type:')}}
            {{Form::select('type', 
            ['Interview' => 'Interview', 'Phone Screen' => 'Phone Screen'], null, ['placeholder' => '-Select Type-', 'class' => 'form-control form-control-dropdown'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/questions">Back</a>
    {!! Form::close() !!}
@endsection