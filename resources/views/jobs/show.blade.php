@extends('layouts.app')

@section('content')
    <h2><strong>Job Title:</strong> {{$job->job_title}}</h2>
    <h3><strong>Job ID:</strong> {{$job->id}}</h3> <br>
    <a class="btn btn-primary" href="/jobs/{{$job->id}}/edit">Edit</a>
    <a class="btn btn-default" href="/jobs">Back</a>
@endsection