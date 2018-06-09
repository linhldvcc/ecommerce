<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Base
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_name',
        'customer_tel',
        'customer_address',
        'customer_note',
        'status',
    ];

    protected $dates = ['deleted_at'];

}
