<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'question_type_id', 'category_id','points'
    ];

     /**
     * Get the comments for the blog post.
     */
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
  
}
