<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Answer extends Model 
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'answers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer', 'question_id', 'is_correct'
    ];


  
}
