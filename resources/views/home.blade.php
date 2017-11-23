@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{auth()->user()->name}}!</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Options:</h3>
                    <div class="list-group">
                        <a href="/applicants" class="list-group-item">Continue to Applicant Table</a>
                        <a href="/applicants/create" class="list-group-item">Add Applicant</a>
                        @if(auth()->user()->role == "Admin")
                            <a href="/questions" class="list-group-item">View Questions</a>
                            <a href="/jobs" class="list-group-item">View Jobs</a>
                            <a href="/users" class="list-group-item">View Users</a>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
