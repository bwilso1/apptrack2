<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;
use App\Job;
use DB;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicants = Applicant::orderBy('created_at', 'desc')->get();
        $jobs = Job::all();
        return view('applicants.index')->with('applicants', $applicants)->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::all();
        return view('applicants.create')->with('jobs', $jobs);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'source' => 'required',
            'location' => 'required',
            'job_title' => 'required'
        ]);

        $applicant = new Applicant;
        $applicant->first_name = $request->input('first_name');
        $applicant->last_name = $request->input('last_name');
        $applicant->source = $request->input('source');
        $applicant->location = $request->input('location');
        $applicant->job_title = $request->input('job_title');
        $applicant->save();

        return redirect('/applicants')->with('success', 'Applicant Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Applicant::find($id);
        DB::statement(
            'CREATE VIEW applicant_answers AS
            SELECT answers.id AS ans_id, answers.response AS response, 
            answers.q_id AS ques_id
            FROM answers
            WHERE answers.a_id = '.$id.';'
        );
        $answers = DB::select(
            DB::raw(
                'SELECT * 
                FROM questions
                LEFT JOIN applicant_answers ON questions.id = ques_id
                WHERE questions.job_title = :job;'
            ),
            array('job' => $applicant->job_title)
        );
        DB::statement('DROP VIEW applicant_answers');

        return view('applicants.show')->with('applicant', $applicant)->with('answers', $answers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicant::find($id);
        $jobs = Job::all();
        $jobArray = array();
        foreach($jobs as $job){
            $jobArray = array_add($jobArray, $job->job_title, $job->job_title);
        }
        return view('applicants.edit')->with('applicant', $applicant)->with('jobArray',$jobArray);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'source' => 'required',
            'location' => 'required',
            'job_title' => 'required'
        ]);

        $applicant = Applicant::find($id);
        $applicant->first_name = $request->input('first_name');
        $applicant->last_name = $request->input('last_name');
        $applicant->source = $request->input('source');
        $applicant->location = $request->input('location');
        $applicant->job_title = $request->input('job_title');

        $applicant->status = $request->input('status');
        $applicant->salary = $request->input('salary');
        $applicant->contractor = $request->input('contractor');
        $applicant->availability = $request->input('availability');
        $applicant->close = $request->input('close');
        
        $applicant->save();

        return redirect('/applicants')->with('success', 'Applicant Successfully Updated');
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
        $jobs = Job::all();
        $applicants = Applicant::orderBy('created_at', 'desc');
        $applicants->where('job_title', '=', $request->input('job_title'));
        return view('applicants.index')->with('applicants', $applicants->get())->with('jobs', $jobs);
    }
}
