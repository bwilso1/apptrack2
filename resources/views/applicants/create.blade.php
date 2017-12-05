@extends('layouts.app')

@section('content')
    <h1 align="center">Add Applicant</h1>
    {!! Form::open(['action' => 'ApplicantsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name:')}}
            {{Form::text('first_name', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name:')}}
            {{Form::text('last_name', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('location', 'Location:')}}
            {{Form::text('location', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('source', 'Source:')}}
            <select class="form-control" name="source" style="width: auto;">
                <option value=''>-Select Source-</option>
                @foreach($sources as $source)
                    <option value='{{$source->id}}'>{{$source->source_name}}</option>
                @endforeach
            </select>
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
            {{Form::label('resume', 'Resume (Optional):')}}
            {{Form::file('resume')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/applicants">Back</a>
    {!! Form::close() !!}
@endsection