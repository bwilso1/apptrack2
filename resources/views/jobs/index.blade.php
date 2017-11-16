@extends('layouts.app')

@section('content')
    <h1 align="center">Jobs</h1> <br>
    <br>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Job Title</th>
            <th>Entered On</th>
        </tr>
        @if(count($jobs) > 0)
            @foreach($jobs as $job)
                <tr>
                    <td>{{$job->id}}</td>
                    <td>{{$job->job_title}}</td>
                    <td>{{$job->created_at}}</td>
                </tr>
            @endforeach
        @else
            <p>No Jobs found</p>
        @endif
    </table> <br>
    <a class="btn btn-primary" href="/jobs/create">Add Job</a>
@endsection