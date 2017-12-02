@extends('layouts.app')

@section('content')
    <h1>Question {{$question->id}}</h1>
    <br>
    <h4><strong>Job:</strong> {{$job->job_title}}</h4>
    <h4><strong>Type:</strong> {{$question->type}}</h4>

    <h3>Content:</h3>
    <div class="well" style="word-wrap: break-word;">{{$question->content}}</div><br>

    <a class="btn btn-primary" href="/questions/{{$question->id}}/edit">Edit</a>
    <a class="btn btn-default" href="/questions">Back</a>
@endsection