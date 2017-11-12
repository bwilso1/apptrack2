@extends('layouts.app')

@section('content')
    <h1>{{$applicant->first_name}} {{$applicant->last_name}}'s {{$type}}</h1>
    <div align="right"><a class="btn btn-default" href="/applicants/{{$applicant->id}}">Back</a></div>
    <div>
        @foreach($answers as $answer)
            <h4>{{$answer->content}}</h4>
            @if(($answer->response) == null)
                <a href="/answers/create/{{$applicant->id}}/{{$answer->id}}">Add Answer</a>
            @else
                <div class="well">{{$answer->response}}</div>
                <a href="/answers/edit/{{$applicant->id}}/{{$answer->ans_id}}">Edit</a>
            @endif
            <br> <br>
        @endforeach
    </div>
@endsection