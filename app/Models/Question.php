<?php

namespace App\Models;


class Question 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'question_type_id', 'category_id','points'
    ];


  
}
