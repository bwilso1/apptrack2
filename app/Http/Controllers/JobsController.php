<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $this->validate($request, [
            'job_title' => 'required|unique:jobs'
        ]);

        $job = new Job;
        $job->job_title = $request->input('job_title');
        $job->save();

        return redirect('/jobs')->with('success', 'Job Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $job = Job::find($id);
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $job = Job::find($id);
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $this->validate($request, [
            'job_title' => 'required|unique:jobs'
        ]);

        $job = Job::find($id);
        $job->job_title = $request->input('job_title');
        $job->save();

        return redirect('/jobs')->with('success', 'Job Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
