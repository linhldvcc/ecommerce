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
        'save_name',
        'original_name',
        'is_thumbnail',
    ];

    public static $save_folder = 'product_image';
    public static $thumb_prefix = 'thumb_';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute()
    {
        //return Storage::url($this->id);
    }

    public function getSavePathAttribute()
    {
        return $this::$save_folder."/".$this->save_name;
    }

    public function getThumbImagePathAttribute()
    {
        return $this::$save_folder."/".$this::$thumb_prefix.$this->save_name;
    }
}
