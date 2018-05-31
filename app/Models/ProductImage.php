<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductImage extends Base
{
    protected $table = 'products_images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'save_path',
        'original_name',
        'is_thumbnail',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute()
    {
        //return Storage::url($this->id);
    }
}
