@extends('layouts.app')

@section('content')
    <h2>{{$question->content}}</h2>
    {!! Form::open(['action' => 'AnswersController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('response', 'Answer:')}}
            {{Form::textarea('response', '', ['class' => 'form-control'])}}
        </div>
        {{ Form::hidden('q_id', $question->id) }}
        {{ Form::hidden('a_id', $a_id) }}
        {{ Form::hidden('type', $question->type) }}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/answers/{{$a_id}}/{{$question->type}}">Back</a>
    {!! Form::close() !!}
@endsection