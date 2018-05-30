<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'desc',
        'price',
        'old_price',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
