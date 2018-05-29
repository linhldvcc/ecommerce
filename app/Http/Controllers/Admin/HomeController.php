<?php

namespace App\Http\Controllers\Admin;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->viewData['title'] = "Tieu de admin";
    }

    public function index()
    {
        //return "DSDSD";
        return view('admin.welcome', $this->viewData);
    }
}
