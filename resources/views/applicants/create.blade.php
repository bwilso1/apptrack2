@extends('layouts.app')

@section('content')
    <h1 align="center">Add Applicant</h1>
    {!! Form::open(['action' => 'ApplicantsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name:')}}
            {{Form::text('first_name', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name:')}}
            {{Form::text('last_name', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('source', 'Source:')}}
            {{Form::text('source', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('location', 'Location:')}}
            {{Form::text('location', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('job_title', 'Job:')}}
            {{Form::select('job_title', ['JavaScript' => 'JavaScript', 'PHP' => 'PHP'], null, ['placeholder' => '-Select Job-'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection