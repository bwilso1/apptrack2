<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\Applicant;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'response' => 'required'
        ]);

        $answer = new Answer;
        $answer->q_id = $request->input('q_id');
        $answer->a_id = $request->input('a_id');
        $answer->response = $request->input('response');
        $answer->save();

        $id = $request->input('a_id');
        $type = $request->input('type');
        $url = '/answers/'.$id.'/'.$type;

        return redirect($url)->with('success', 'Answer Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'response' => 'required'
        ]);

        $answer = Answer::find($id);
        $answer->response = $request->input('response');
        $answer->save();

        $a_id = $request->input('a_id');
        $type = $request->input('type');
        $url = '/answers/'.$a_id.'/'.$type;

        return redirect($url)->with('success', 'Answer Successfully Updated');
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
