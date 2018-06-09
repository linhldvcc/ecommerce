<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Base
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
    ];

    protected $dates = ['deleted_at'];

}
