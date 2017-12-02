@extends('layouts.app')

@section('content')
<h1> {{$applicant->first_name}} {{$applicant->last_name}} </h1> 
<table class="table table-bordered" id="appInfo">
    <tr>
        <td><strong>Last Name:</strong></td>
        <td>{{$applicant->last_name}}</td>
        <td><strong>Source:</strong></td>
        <td >{{$source->source_name}}</td>
    </tr>
   <tr>
     <td><strong>First Name:</strong></td>
     <td>{{$applicant->first_name}}</td>
	<td><strong>Location:</strong></td>
     <td>{{$applicant->location}}</td>
   </tr>
   <tr>
     <td><strong>Job Title:</strong></td>
     <td> {{$job->job_title}}</td>
     <td><strong>Conveniant to Columbia:</strong></td>
     <td >{{$applicant->close}}</td>

   </tr>

   <tr>

     <td><strong>Availability:</strong></td>

     <td >{{$applicant->availability}}</td>

     <td><strong>Willling to contract?</strong></td>

     <td>{{$applicant->contractor}} </td>

   </tr>


   <tr>
    <td><strong>Status:</strong></td>
    <td>{{$applicant->status}}</td>
    @if(auth()->user()->role != "Dev")
      <td><strong>View Salary</strong></td>
      <td>{{$applicant->salary}}</td>
    @endif
   </tr>
</table>
<div align="right">
    <a class="btn btn-primary" href="/applicants/{{$applicant->id}}/edit">Edit</a>
    <button class="btn btn-secondary" onclick="location.href = '/applicants/';">Back</button>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#interview">Interview</a></li>
  <li><a data-toggle="tab" href="#phone">Phone Screen</a></li>
  <li><a data-toggle="tab" href="#assess">Assessment</a></li>
</ul>
<div class="tab-content">
  <div id="interview" class="tab-pane fade in active">
    <h2>Interview Questions</h2>
    <div align="right"><a href="/answers/{{$applicant->id}}/Interview">Advanced Options</a></div>
    @foreach($answers as $answer)
      @if(($answer->type) == "Interview")
        <h4>{{$answer->content}}</h4>
        <div class="well" style="word-wrap: break-word;">{{$answer->response}}</div>
      @endif
    @endforeach
  </div>
  <div id="phone" class="tab-pane fade">
    <h2>Phone Screen Questions</h2>
    <div align="right"><a href="/answers/{{$applicant->id}}/Phone Screen">Advanced Options</a></div>
    @foreach($answers as $answer)
      @if(($answer->type) == "Phone Screen")
        <h4>{{$answer->content}}</h4>
        <div class="well" style="word-wrap: break-word;">{{$answer->response}}</div>
      @endif
    @endforeach
  </div>
  <div id="assess" class="tab-pane fade">
    <h2>Assessment</h2>
    <p>The assessment of the applicant will be here.</p>
  </div>
</div>
@endsection