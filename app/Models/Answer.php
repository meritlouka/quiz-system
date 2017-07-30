<?php

namespace App\Models;


class Answer 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer', 'question_id', 'is_correct'
    ];


  
}
