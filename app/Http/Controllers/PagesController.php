<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Applicant;
use DB;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function controlpanel(){
        return view('pages.controlpanel');
    }

    public function createAnswer($a_id, $q_id){
        $question = Question::find($q_id);
        return view('pages.createanswer')->with('question', $question)->with('a_id', $a_id);
    }

    public function editAnswer($a_id, $id){
        $answer = Answer::find($id);
        $question = Question::find($answer->q_id);
        return view('pages.editanswer')->with('answer', $answer)->with('question', $question);
    }

    public function showAnswers($id, $type){
        $applicant = Applicant::find($id);
        $answers = DB::table('questions')
        ->leftJoin('answers', 'questions.id', '=', 'answers.q_id')
        ->where('job_title', '=', $applicant->job_title)
        ->where('type', '=', $type)
        ->where(function($query) use ($id){
            $query->where('a_id', '=', $id);
            $query->orWhere('a_id', '=', null);
        })
        ->select('questions.id as ques_id', 'answers.id as ans_id', 'content', 'response')
        ->get();
        return view('pages.showanswers')->with('applicant', $applicant)
        ->with('answers', $answers)->with('type', $type);
    }
}
