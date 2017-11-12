@extends('layouts.app')

@section('content')
    <h2>{{$question->content}}</h2>
    {!! Form::open(['action' => ['AnswersController@update', $answer->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('response', 'Answer:')}}
            {{Form::textarea('response', $answer->response, ['class' => 'form-control'])}}
        </div>
        {{ Form::hidden('a_id', $answer->a_id) }}
        {{ Form::hidden('type', $question->type) }}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/answers/{{$answer->a_id}}/{{$question->type}}">Back</a>
    {!! Form::close() !!}
@endsection