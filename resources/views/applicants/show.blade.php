@extends('layouts.app')

@section('content')
<h1> {{$applicant->first_name}} {{$applicant->last_name}} </h1> 
<table class="table table-bordered" id="appInfo">
    <tr>
        <td><strong>Last Name:</strong></td>
        <td>{{$applicant->last_name}}</td>
        <td><strong>Source:</strong></td>
        <td >{{$applicant->source}}</td>
    </tr>
   <tr>
     <td><strong>First Name:</strong></td>
     <td>{{$applicant->first_name}}</td>
	<td><strong>Location:</strong></td>
     <td>{{$applicant->location}}</td>
   </tr>
   <tr>
     <td><strong>Job Title:</strong></td>
     <td> {{$applicant->job_title}}</td>
     <td><strong>Conveniant to Columbia:</strong></td>
     <td >{{$applicant->close}}</td>

   </tr>

   <tr>

     <td><strong>Availability:</strong></td>

     <td >{{$applicant->availability}}</td>

     <td><strong>Willling to contract?</strong></td>

     <td>{{$applicant->contrator}} </td>

   </tr>


   <tr>
    <td><strong>Status:</strong></td>
    <td>{{$applicant->status}}</td>
    <td><strong>View Salary</strong></td>
    <td>{{$applicant->salary}}</td>
   </tr>
</table>
<div align="right">
    <button class="btn btn-primary">Edit</button>
    <button class="btn btn-secondary" onclick="location.href = '/applicants/';">Back</button>
<div>
@endsection