<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Source;

class SourcesController extends Controller
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
        $sources = Source::all();
        return view('sources.index')->with('sources', $sources);
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
        return view('sources.create');
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
            'source_name' => 'required'
        ]);

        $source = new Source;
        $source->source_name = $request->input('source_name');
        $source->save();

        return redirect('/sources')->with('success', 'Source Successfully Added');
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
        $source = Source::find($id);
        return view('sources.show')->with('source', $source);
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
        $source = Source::find($id);
        return view('sources.edit')->with('source', $source);
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
            'source_name' => 'required'
        ]);

        $source = Source::find($id);
        $source->source_name = $request->input('source_name');
        $source->save();

        return redirect('/sources')->with('success', 'Source Successfully Updated');
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
