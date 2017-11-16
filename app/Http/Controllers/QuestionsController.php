<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Job;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('questions.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::all();
        return view('questions.create')->with('jobs', $jobs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'job_title' => 'required',
            'type' => 'required'
        ]);

        $question = new Question;
        $question->content = $request->input('content');
        $question->job_title = $request->input('job_title');
        $question->type = $request->input('type');
        $question->save();

        return redirect('/questions')->with('success', 'Question Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $jobs = Job::all();
        $jobArray = array();
        foreach($jobs as $job){
            $jobArray = array_add($jobArray, $job->job_title, $job->job_title);
        }
        return view('questions.edit')->with('question', $question)->with('jobArray',$jobArray);
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
        $this->validate($request, [
            'content' => 'required',
            'job_title' => 'required',
            'type' => 'required'
        ]);

        $question = Question::find($id);
        $question->content = $request->input('content');
        $question->job_title = $request->input('job_title');
        $question->type = $request->input('type');
        $question->save();

        return redirect('/questions')->with('success', 'Question Successfully Updated');
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
