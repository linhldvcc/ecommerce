<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    protected $viewData;

    public function __construct()
    {
        $this->viewData = [];

        $this->viewData['cart'] = session()->get('cart', []);
    }
}
