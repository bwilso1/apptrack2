@extends('layouts.app')

@section('content')
    <h1 align="center">Questions</h1> <br>
    <br>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Content</th>
            <th>Job</th>
            <th>Type</th>
            <th>Entered On</th>
        </tr>
        @if(count($questions) > 0)
            @foreach($questions as $question)
                <tr>
                    <td><a href="/questions/{{$question->id}}">{{$question->id}}</a></td>
                    <td>{{$question->content}}</td>
                    <td>{{$question->job_title}}</td>
                    <td>{{$question->type}}</td>
                    <td>{{$question->created_at}}</td>
                </tr>
            @endforeach
        @else
            <p>No Questions found</p>
        @endif
    </table> <br>
    <a class="btn btn-primary" href="/questions/create">Add Question</a>
@endsection