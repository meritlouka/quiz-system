<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\LkpCategory;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
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
		// get all the questions
		$questions = Question::all();
		// load the view and pass the questions
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
		// get all the questions
		$categories = LkpCategory::all();
		// load the create form (app/views/questions/create_true_false.blade.php)
		return response()
                ->view('questions.create_true_false', compact('categories'))
                //->with('categories', $categories)
                ;
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeTrueFalse()
	{

		// validate
		// read more on validation at http://laravel.com/docs/validation
		// $rules = array(
		// 	'name'       => 'required',
		// 	'email'      => 'required|email',
		// 	'question_level' => 'required|numeric'
		// );
		// $validator = Validator::make(Input::all(), $rules);
		// // process the login
		// if ($validator->fails()) {
		// 	return Redirect::to('questions/create')
		// 		->withErrors($validator)
		// 		->withInput(Input::except('password'));
		// } else {
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
		//}
	}
		/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createMultiChoice()
	{
		// load the create form (app/views/questions/create.blade.php)
		return View::make('questions.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeMultiChoice()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'name'       => 'required',
			'email'      => 'required|email',
			'question_level' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);
		// process the login
		if ($validator->fails()) {
			return Redirect::to('questions/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$question = new Question;
			$question->name       = Input::get('name');
			$question->email      = Input::get('email');
			$question->question_level = Input::get('question_level');
			$question->save();
			// redirect
			Session::flash('message', 'Successfully created question!');
			return Redirect::to('questions');
		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the question
		$question = Question::find($id);
		// show the view and pass the question to it
		return View::make('questions.show')
			->with('question', $question);
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
		}elseif($question->question_type_id == 2){
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
		// validate
		// read more on validation at http://laravel.com/docs/validation
		// $rules = array(
		// 	'name'       => 'required',
		// 	'email'      => 'required|email',
		// 	'question_level' => 'required|numeric'
		// );
		// $validator = Validator::make(Input::all(), $rules);
		// // process the login
		// if ($validator->fails()) {
		// 	return Redirect::to('questions/' . $id . '/edit')
		// 		->withErrors($validator)
		// 		->withInput(Input::except('password'));
		// } else {
			// store

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
		//}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$question = Question::find($id);
		$question->delete();
		// redirect
		Session::flash('message', 'Successfully deleted the question!');
		return Redirect::to('questions');
	}
}