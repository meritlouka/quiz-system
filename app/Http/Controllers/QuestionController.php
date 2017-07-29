<?php
class questionController extends \BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the questions
		$questions = question::all();
		// load the view and pass the questions
		return View::make('questions.index')
			->with('questions', $questions);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/questions/create.blade.php)
		return View::make('questions.create');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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
			$question = new question;
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
		$question = question::find($id);
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
		// get the question
		$question = question::find($id);
		// show the edit form and pass the question
		return View::make('questions.edit')
			->with('question', $question);
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
		$rules = array(
			'name'       => 'required',
			'email'      => 'required|email',
			'question_level' => 'required|numeric'
		);
		$validator = Validator::make(Input::all(), $rules);
		// process the login
		if ($validator->fails()) {
			return Redirect::to('questions/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$question = question::find($id);
			$question->name       = Input::get('name');
			$question->email      = Input::get('email');
			$question->question_level = Input::get('question_level');
			$question->save();
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
	public function destroy($id)
	{
		// delete
		$question = question::find($id);
		$question->delete();
		// redirect
		Session::flash('message', 'Successfully deleted the question!');
		return Redirect::to('questions');
	}
}