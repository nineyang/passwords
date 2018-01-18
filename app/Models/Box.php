<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends BaseModel
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'sort', 'status', 'type', 'created_at', 'updated_at', 'passwords'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
