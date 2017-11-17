@extends('layouts.app')

@section('head')
    <style>
        #scroll {
            overflow:hidden;
            overflow-y: scroll;
            height: 300px;
        }
    </style>
@endsection

@section('content')
    <h1 align="center">Questions</h1> <br>
    {!! Form::open(array('action' => array('QuestionsController@filter'), 'role'=>'search', 'method' => 'GET')) !!}
        <div class="form-group">
            <table class="table">
                <tr>
                    <td>{{Form::label('job_title', 'Job:')}}</td>
                    <td><select name="job_title">
                        <option value=''>-Select Job-</option>
                        @foreach($jobs as $job)
                            <option value='{{$job->job_title}}'>{{$job->job_title}}</option>
                        @endforeach
                    </select></td>
                    <td>{{Form::label('type', 'Type:')}}</td>
                    <td>{{Form::select('type', ['Interview' => 'Interview', 'Phone Screen' => 'Phone Screen'], null, 
                    ['placeholder' => '-Select Type-'])}}</td>
                </tr>
            </table>
        </div>
        {{Form::submit('Search', ['class' => 'btn btn-default'])}}
    {!! Form::close() !!}
    <br>
    <div id="scroll">
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
    </table>
    </div> <br>
    <a class="btn btn-primary" href="/questions/create">Add Question</a>
@endsection