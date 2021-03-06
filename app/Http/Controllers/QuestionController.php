<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\LkpCategory;
use Validator;
use App\Http\Controllers\Controller;
use Redirect;
use Response;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Session;
class questionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$questions = Question::all();
		
		return View::make('questions.index')
			->with('questions', $questions);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createTrueFalse()
	{

		$categories = LkpCategory::all();

		return response()
                ->view('questions.create_true_false', compact('categories'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeTrueFalse()
	{

		$rules = array(
			'question'       => 'required',
			
		);
		$validator = Validator::make(Input::all(), $rules);
		// process the login
		if ($validator->fails()) {
			return Redirect::to('questions/createTrueFalse')
				->withErrors($validator)
				;
		} else {
			// store
		
			$question = new Question;
			$question->question       = Input::get('question');
			$question->question_type_id      = 1;
			$question->category_id = Input::get('category_id');
			$question->points = 10;
			$question->save();
			
			$answer = new Answer;
            $answer->answer = "True" ;
            $answer->question_id = $question->id ;
            $answer->is_correct = Input::get('is_correct') === "true" ? '1' : '0' ;
            $answer->save();
            $answer = new Answer;
            $answer->answer = "False" ;
            $answer->question_id = $question->id ;
            $answer->is_correct = Input::get('is_correct') === "false" ? '1' : '0' ;
			$answer->save();
			// redirect
			Session::flash('message', 'Successfully created question!');
			return Redirect::to('questions');
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createMultiChoice()
	{
		return View::make('questions.create');
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{   
		$categories = LkpCategory::all();
		// get the question
		$question = Question::find($id);
        $correctAnswer = $question->answers()->where('is_correct','=','1')->get()->first()->answer;
        
	
		// show the edit form and pass the question
		if ($question->question_type_id == 1){
			return View::make('questions.edit_true_false')
				->with(['question'=> $question,'categories'=>$categories,'correctAnswer'=>$correctAnswer]);
		}
		elseif($question->question_type_id == 2){
			return View::make('questions.edit_multi_choice')
				->with('question', $question);
		}


	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'question'       => 'required',
			
		);
		 $validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('questions/' . $id . '/edit')
				->withErrors($validator)
				;
		} else {

			$question = Question::find($id);
			$question->question       = Input::get('question');
			$question->question_type_id      = 1;
			$question->category_id = Input::get('category_id');
			$question->points = 10;
			$question->save();
			$question->answers()->delete();

			$answer = new Answer;
            $answer->answer = "True" ;
            $answer->question_id = $question->id ;
            $answer->is_correct = Input::get('is_correct') === "true" ? '1' : '0' ;
            $answer->save();
            $answer = new Answer;
            $answer->answer = "False" ;
            $answer->question_id = $question->id ;
            $answer->is_correct = Input::get('is_correct') === "false" ? '1' : '0' ;
			$answer->save();
			// redirect
			Session::flash('message', 'Successfully updated question!');
			return Redirect::to('questions');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete()
	{

        foreach (Input::get('checkbox') as $key => $value) {
        	# code...
        	Question::find($value)->delete();
        	Answer::where('question_id','=',$value)->delete();
        }
		
		
		
		// redirect
		Session::flash('message', 'Successfully deleted the question!');
		return Redirect::to('questions');
	}
}