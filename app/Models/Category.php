<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
