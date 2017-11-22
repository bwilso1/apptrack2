@extends('layouts.app')

@section('content')
    <h1 align="center">Users</h1> <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Entered On</th>
            </tr>
        </thead>
        <tbody>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr>
                    <td><a href="/users/{{$user->id}}">{{$user->id}}</a></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->created_at}}</td>
                </tr>
            @endforeach
        @else
            <p>No Users found</p>
        @endif
        </tbody>
    </table> <br>
    <a class="btn btn-primary" href="/users/create">Add User</a>
@endsection