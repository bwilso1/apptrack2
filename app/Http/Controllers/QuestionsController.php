<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Job;
use DB;

class QuestionsController extends Controller
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
        $questions = Question::select('questions.*', 'jobs.job_title')->join('jobs', 'questions.job_title', '=', 'jobs.id')->orderBy('questions.created_at', 'asc')->get();
        return view('questions.index')->with('jobs', $jobs)->with('questions', $questions);
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
        if(auth()->user()->role != "Admin")
            return redirect('/home');
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
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $question = Question::find($id);
        $job = Job::find($question['job_title']);
        return view('questions.show')->with('question', $question)->with('job', $job);
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
        $question = Question::find($id);
        $jobs = Job::all();
        $jobArray = array();
        foreach($jobs as $job){
            $jobArray = array_add($jobArray, $job->id, $job->job_title);
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
        if(auth()->user()->role != "Admin")
            return redirect('/home');
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

    public function filter(Request $request){
        if(auth()->user()->role != "Admin")
            return redirect('/home');
        $jobs = Job::all();
        $questions = DB::table('questions');
        if(!empty($request->input('job_title')))
            $questions->where('questions.job_title', '=', $request->input('job_title'));
        if(!empty($request->input('type')))
            $questions->where('type', '=', $request->input('type'));
        $questions->select('questions.*', 'jobs.job_title')->join('jobs', 'questions.job_title', 'jobs.id')->orderBy('questions.created_at', 'asc');
        return view('questions.index')->with('questions', $questions->get())->with('jobs', $jobs);
    }
}
