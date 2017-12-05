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
    <h1 align="center">Edit User</h1>
    {!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', $user->name, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email:')}}
            {{Form::text('email', $user->email, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Password (Optional):')}}
            {{Form::password('password', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('password_confirmation', 'Confirm Password:')}}
            {{Form::password('password_confirmation', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('role', 'Role:')}}
            {{Form::select('role', 
            ['Admin' => 'Admin', 'HR' => 'HR', 'Dev' => 'Dev', 'Deactivated' => 'Deactivate'], $user->role, ['class' => 'form-control form-control-dropdown'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-default" href="/users/{{$user->id}}">Back</a>
    {!! Form::close() !!}
@endsection