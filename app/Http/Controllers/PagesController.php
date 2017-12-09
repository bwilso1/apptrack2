<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Applicant;
use DB;

class PagesController extends Controller
{
    // For the first page
    public function index(){
        return view('pages.index');
    }

    // A view that allows user to create an answer to an applicant's Interview/Phone Screen question.
    public function createAnswer($a_id, $q_id){
        $question = Question::find($q_id);
        return view('pages.createanswer')->with('question', $question)->with('a_id', $a_id);
    }

    // A view that allows user to edit an answer to an applicant's Interview/Phone Screen question.
    public function editAnswer($a_id, $id){
        $answer = Answer::find($id);
        $question = Question::find($answer->q_id);
        return view('pages.editanswer')->with('answer', $answer)->with('question', $question);
    }

    // A view that displays all the Interview/Phone Screen questions and answers of an applicant
    public function showAnswers($id, $type){
        $applicant = Applicant::find($id);
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
                WHERE questions.job_title = :job AND questions.type = :type;'
            ),
            array('job' => $applicant->job_title, 'type' => $type)
        );
        DB::statement('DROP VIEW applicant_answers'.$userId);

        return view('pages.showanswers')->with('applicant', $applicant)
        ->with('answers', $answers)->with('type', $type);
    }
}
