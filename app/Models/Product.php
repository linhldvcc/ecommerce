<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Base
{
    use SoftDeletes;
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

    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function idArrOfCategories()
    {
        return $this->categories()->pluck('id')->toArray();
    }

    public function scopeOrderByIdDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function getThumbnailURLAttribute()
    {
        return $this->images()->first() ? $this->images()->first()->thumbnailURL : '';
    }
}
