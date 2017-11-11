@extends('layouts.app')

@section('content')
    <h1 align="center">Edit Applicant</h1>
    {!! Form::open(['action' => ['ApplicantsController@update', $applicant->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name:')}}
            {{Form::text('first_name', $applicant->first_name, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name:')}}
            {{Form::text('last_name', $applicant->last_name, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('source', 'Source:')}}
            {{Form::text('source', $applicant->source, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('location', 'Location:')}}
            {{Form::text('location', $applicant->location, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('job_title', 'Job:')}}
            {{Form::select('job_title', ['JavaScript' => 'JavaScript', 'PHP' => 'PHP'], $applicant->job_title)}}
        </div>
        <div class="form-group">
            {{Form::label('availability', 'Availability:')}}
            {{Form::text('availability', $applicant->availability, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status:')}}
            {{Form::select('status', 
            ['New' => 'New', 'Waiting for Input' => 'Waiting for Input', 'Pending in Review' => 'Pending in Review',
            'Schedule Phone Screen' => 'Schedule Phone Screen', 'Phone Screen Completed, Schedule Interview' => 'Phone Screen Completed, Schedule Interview',
            'Interview Complete' => 'Interview Complete', 'Wait and See' => 'Wait and See', 'Offer' => 'Offer', 'Not in Consideration' => 'Not in Consideration',
            'Hired - Offer Accepted' => 'Hired - Offer Accepted', 'Offer Rejected' => 'Offer Rejected'], 
            $applicant->status)}}
        </div>
        <div class="form-group">
            {{Form::label('close', 'Conveniant to Columbia:')}}
            {{Form::select('close', ['' => '', 'Yes' => 'Yes', 'No' => 'No'], $applicant->close)}}
        </div>
        <div class="form-group">
            {{Form::label('contractor', 'Willing to Contract?')}}
            {{Form::select('contractor', ['' => '', 'Yes' => 'Yes', 'No' => 'No'], $applicant->contractor)}}
        </div>
        <div class="form-group">
            {{Form::label('salary', 'Salary:')}}
            {{Form::text('salary', $applicant->salary, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection