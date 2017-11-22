@extends('layouts.app')

@section('content')
    <h1 align="center">Users</h1> <br>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr>
                    <td><a href="#">{{$user->id}}</a></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                </tr>
            @endforeach
        @else
            <p>No Users found</p>
        @endif
    </table> <br>
    <a class="btn btn-primary" href="/users/create">Add User</a>
@endsection