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
    <h1 align="center">Add User</h1>
    {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email:')}}
            {{Form::text('email', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Password:')}}
            {{Form::text('password', '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('role', 'Role:')}}
            {{Form::select('role', 
            ['admin' => 'Admin', 'hr' => 'HR', 'dev' => 'Dev'], null, ['placeholder' => '-Select Role-', 'class' => 'form-control form-control-dropdown'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/questions">Back</a>
    {!! Form::close() !!}
@endsection