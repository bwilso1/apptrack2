@extends('layouts.app')

@section('content')
    <h1 align="center">Applicants</h1> <br>

    {!! Form::open(array('action' => array('ApplicantsController@filter'), 'role'=>'search', 'method' => 'GET')) !!}
        <div class="form-group">
            <table class="table">
                <tr>
                    <td>{{Form::label('job_title', 'Job:')}}</td>
                    <td><select name="job_title">
                        <option value=''>-Select Job-</option>
                        @foreach($jobs as $job)
                            <option value='{{$job->id}}'>{{$job->job_title}}</option>
                        @endforeach
                    </select></td>
                    <td>{{Form::label('source', 'Source:')}}</td>
                    <td><select name="source">
                        <option value=''>-Select Source-</option>
                        @foreach($sources as $source)
                            <option value='{{$source->id}}'>{{$source->source_name}}</option>
                        @endforeach
                    </select></td>
                    <td>{{Form::label('status', 'Status:')}}</td>
                    <td>{{Form::select('status', 
                    ['New' => 'New', 'Waiting for Input' => 'Waiting for Input', 'Pending in Review' => 'Pending in Review',
                    'Schedule Phone Screen' => 'Schedule Phone Screen', 'Phone Screen Completed, Schedule Interview' => 'Phone Screen Completed, Schedule Interview',
                    'Interview Complete' => 'Interview Complete', 'Wait and See' => 'Wait and See', 'Offer' => 'Offer', 'Not in Consideration' => 'Not in Consideration',
                    'Hired - Offer Accepted' => 'Hired - Offer Accepted', 'Offer Rejected' => 'Offer Rejected'], 
                    null, ['placeholder' => '-Select Status-'])}}</td>
                </tr>
                <tr>
                    <td>{{Form::label('contractor', 'Contractor:')}}</td>
                    <td>{{Form::select('contractor', ['Yes' => 'Yes', 'No' => 'No'], null, ['placeholder' => '-Select Option-'])}}</td>
                    <td>{{Form::label('part_time', 'Part Time:')}}</td>
                    <td>{{Form::select('part_time', ['Yes' => 'Yes', 'No' => 'No'], null, ['placeholder' => '-Select Option-'])}}</td>
                    <td>{{Form::label('remote', 'Remote:')}}</td>
                    <td>{{Form::select('remote', ['Yes' => 'Yes', 'No' => 'No'], null, ['placeholder' => '-Select Option-'])}}</td>
                </tr>
                <tr>
                    <td>{{Form::label('first_name', 'First Name:')}}</td>
                    <td><input type="text" name="first_name"></td>
                    <td>{{Form::label('last_name', 'Last Name:')}}</td>
                    <td><input type="text" name="last_name"></td>
                </tr>
            </table>
        </div>
        {{Form::submit('Search', ['class' => 'btn btn-default'])}}
    {!! Form::close() !!}

    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Job</th>
                <th>Status</th>
                <th>Source</th>
                <th>Entered On</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table> <br>
    <a class="btn btn-primary" href="/applicants/create" >Add Applicant</a>
@endsection