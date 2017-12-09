<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        // Gets all applicants that are active, joins them with their jobs and sources, and orders them by entry date.
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
            'job_title' => 'required',
            'resume' => 'max:1999'
        ]);

        $applicant = new Applicant;
        $applicant->first_name = $request->input('first_name');
        $applicant->last_name = $request->input('last_name');
        $applicant->source = $request->input('source');
        $applicant->location = $request->input('location');
        $applicant->job_title = $request->input('job_title');
        // File Upload
        if($request->hasFile('resume')){
            // Get filename with the extension
            $filenameWithExt = $request->file('resume')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('resume')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('resume')->storeAs('public/resumes', $filenameToStore);
            // Save to Database
            $applicant->resume = $filenameToStore;
        }
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
        // The DB queries create a view of an individual applicant's answers and joins them with their respective questions based on job title
        DB::statement('DROP VIEW IF EXISTS applicant_answers'.$userId);
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
        // Creating a jobs array for the drop-down menu on the form
        foreach($jobs as $job){
            $jobArray = array_add($jobArray, $job->id, $job->job_title);
        }
        // Creating a sources array for the drop-down menu on the form
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
            'job_title' => 'required',
            'resume' => 'max:1999'
        ]);

        $applicant = Applicant::find($id);
        $applicant->first_name = $request->input('first_name');
        $applicant->last_name = $request->input('last_name');
        $applicant->source = $request->input('source');
        $applicant->location = $request->input('location');
        $applicant->job_title = $request->input('job_title');
        // File Upload
        if($request->hasFile('resume')){
            // Delete previously uploaded file if exists
            if($applicant->resume != null){
                Storage::delete('public/resumes/'.$applicant->resume);
            }
            // Get filename with the extension
            $filenameWithExt = $request->file('resume')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('resume')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('resume')->storeAs('public/resumes', $filenameToStore);
            // Save to Database
            $applicant->resume = $filenameToStore;
        }

        $applicant->status = $request->input('status');
        if(auth()->user()->role != "Dev"){
            $applicant->salary = $request->input('salary');
        }
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
        // Checks to see which search options have been selected and does where statements to filter out what the user wants.
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
