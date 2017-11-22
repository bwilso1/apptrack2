@extends('layouts.app')

@section('content')
    <h1 align="center">{{$user->name}}</h1> <br>
    <a class="btn btn-default" href="/users">Back</a>
    <table class="table">
        <tr><h3><td><strong>Name:</strong></td> <td>{{$user->name}}</td></h3></tr>
        <tr><h3><td><strong>ID:</strong></td> <td>{{$user->id}}</td></h3></tr>
        <tr><h3><td><strong>Email:</strong></td> <td>{{$user->email}}</td></h3></tr>
        <tr><h3><td><strong>Role:</strong></td> <td>{{$user->role}}</td></h3></tr> <br>
    </table>
    <a class="btn btn-primary" style="margin-right:10px;" href="#">Edit</a>
    <a class="btn btn-primary" href="#">Change Password</a>
@endsection