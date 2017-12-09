@extends('layouts.app')

@section('head')
    <style>
        .form-control-dropdown 
        {
            width: auto;
        }
        .form-control-input{
            width: 50%;
        }
    </style>
@endsection

@section('content')
    <h1 align="center">Edit Applicant</h1>
    {!! Form::open(['action' => ['ApplicantsController@update', $applicant->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('first_name', 'First Name:')}}
            {{Form::text('first_name', $applicant->first_name, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('last_name', 'Last Name:')}}
            {{Form::text('last_name', $applicant->last_name, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('location', 'Location:')}}
            {{Form::text('location', $applicant->location, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('source', 'Source:')}}
            {{Form::select('source', $sourceArray, $applicant->source, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('job_title', 'Job:')}}
            {{Form::select('job_title', $jobArray, $applicant->job_title, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('resume', 'Resume (Optional):')}}
            {{Form::file('resume')}}
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
            'Hired - Offer Accepted' => 'Hired - Offer Accepted', 'Offer Rejected' => 'Offer Rejected', 'Deactivated' => 'Deactivate'], 
            $applicant->status, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('remote', 'Remote:')}}
            {{Form::select('remote', ['' => '', 'Yes' => 'Yes', 'No' => 'No'], $applicant->remote, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('part_time', 'Part Time:')}}
            {{Form::select('part_time', ['' => '', 'Yes' => 'Yes', 'No' => 'No'], $applicant->part_time, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('close', 'Conveniant to Columbia:')}}
            {{Form::select('close', ['' => '', 'Yes' => 'Yes', 'No' => 'No'], $applicant->close, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        <div class="form-group">
            {{Form::label('contractor', 'Willing to Contract?')}}
            {{Form::select('contractor', ['' => '', 'Yes' => 'Yes', 'No' => 'No'], $applicant->contractor, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        @if(auth()->user()->role != "Dev")
            <div class="form-group">
                {{Form::label('salary', 'Salary:')}}
                {{Form::text('salary', $applicant->salary, ['class' => 'form-control'])}}
            </div>
        @endif
        <div class="form-group">
            {{Form::label('assessment', 'Assessment:')}}
            {{Form::textarea('assessment', $applicant->assessment, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/applicants/{{$applicant->id}}">Back</a>
    {!! Form::close() !!}
@endsection