<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;
use App\Job;
use App\Source;
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
        $applicants = Applicant::select('applicants.*', 'jobs.job_title', 'sources.source_name AS source')->where('status', '<>', 'Deactivated')->join('jobs', 'applicants.job_title', '=', 'jobs.id')
        ->join('sources', 'applicants.source', '=', 'sources.id')->orderBy('applicants.created_at', 'desc')->get();
        $jobs = Job::all();
        $sources = Source::all();
        return view('applicants.index')->with('applicants', $applicants)->with('jobs', $jobs)->with('sources', $sources);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::all();
        $sources = Source::all();
        return view('applicants.create')->with('jobs', $jobs)->with('sources', $sources);
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
        $job = Job::find($applicant['job_title']);
        $source = Source::find($applicant['source']);
        $userId = auth()->user()->id;
        DB::statement(
            'CREATE VIEW applicant_answers'.$userId.' AS
            SELECT answers.id AS ans_id, answers.response AS response, 
            answers.q_id AS ques_id
            FROM answers
            WHERE answers.a_id = '.$id.';'
        );
        $answers = DB::select(
            DB::raw(
                'SELECT * 
                FROM questions
                LEFT JOIN applicant_answers'.$userId.' ON questions.id = ques_id
                WHERE questions.job_title = :job;'
            ),
            array('job' => $applicant->job_title)
        );
        DB::statement('DROP VIEW applicant_answers'.$userId);

        return view('applicants.show')->with('applicant', $applicant)->with('answers', $answers)->with('job', $job)->with('source', $source);
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
        $sources = Source::all();
        $jobArray = array();
        $sourceArray = array();
        foreach($jobs as $job){
            $jobArray = array_add($jobArray, $job->id, $job->job_title);
        }
        foreach($sources as $source){
            $sourceArray = array_add($sourceArray, $source->id, $source->source_name);
        }
        return view('applicants.edit')->with('applicant', $applicant)->with('jobArray',$jobArray)->with('sourceArray', $sourceArray);
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
        $applicant->remote = $request->input('remote');
        $applicant->part_time = $request->input('part_time');
        $applicant->contractor = $request->input('contractor');
        $applicant->availability = $request->input('availability');
        $applicant->close = $request->input('close');
        $applicant->assessment = $request->input('assessment');
        
        $applicant->save();

        return redirect('/applicants/'.$id)->with('success', 'Applicant Successfully Updated');
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
        $sources = Source::all();
        $applicants = DB::table('applicants');
        if(!empty($request->input('job_title')))
            $applicants->where('applicants.job_title', '=', $request->input('job_title'));
        if(!empty($request->input('source')))
            $applicants->where('applicants.source', '=', $request->input('source'));    
        if(!empty($request->input('status')))
            $applicants->where('status', '=', $request->input('status'));    
        if(!empty($request->input('first_name')))
            $applicants->where('first_name', 'like', '%'.$request->input('first_name').'%');
        if(!empty($request->input('last_name')))
            $applicants->where('last_name', 'like', '%'.$request->input('last_name').'%');
        if(!empty($request->input('part_time')))
            $applicants->where('part_time', '=', $request->input('part_time'));
        if(!empty($request->input('remote')))
            $applicants->where('remote', '=', $request->input('remote'));
        if(!empty($request->input('contractor')))
            $applicants->where('contractor', '=', $request->input('contractor'));
        $applicants->select('applicants.*', 'jobs.job_title', 'sources.source_name AS source')->where('status', '<>', 'Deactivated')->join('jobs', 'applicants.job_title', '=', 'jobs.id')
        ->join('sources', 'applicants.source', '=', 'sources.id')->orderBy('applicants.created_at', 'desc');    
        return view('applicants.index')->with('applicants', $applicants->get())->with('jobs', $jobs)->with('sources', $sources);
    }
}
