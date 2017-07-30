<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkpCategory extends Model


{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lkp_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];
     

  
}
