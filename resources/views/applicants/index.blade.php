@extends('layouts.app')

@section('content')
    <h1 align="center">Applicants</h1> <br>

    {!! Form::open(array('action' => array('ApplicantsController@index'), 'role'=>'search', 'method' => 'GET')) !!}
        <div class="form-group">
            {{Form::label('job_title', 'Job:')}}
            {{Form::select('job_title', ['JavaScript' => 'JavaScript', 'PHP' => 'PHP'], null, ['placeholder' => '-Select Job-'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    <br>

    <table class="table table-hover">
        <tr>
            <th>Name</th>
            <th>Job</th>
            <th>Status</th>
            <th>Source</th>
            <th>Entered On</th>
            <th>Location</th>
        </tr>
        @if(count($applicants) > 0)
            @foreach($applicants as $applicant)
                <tr>
                    <td><a href="/applicants/{{$applicant->id}}">{{$applicant->last_name}}, {{$applicant->first_name}}</a></td>
                    <td>{{$applicant->job_title}}</td>
                    <td>{{$applicant->status}}</td>
                    <td>{{$applicant->source}}</td>
                    <td>{{$applicant->created_at}}</td>
                    <td>{{$applicant->location}}</td>
                </tr>
            @endforeach
        @else
            <p>No Applicants found</p>
        @endif
    </table> <br>
    <button class="btn btn-primary" onclick="location.href = '/applicants/create';" >Add Applicant</button>
@endsection