<?php

namespace App\Http\Controllers\Web;

use App\Mail\User\WelcomeMail;
use App\Models\User;
use App\Services\Helpers\EmailService;
use App\Services\Web\Contracts\CategoryServiceInterface;
use App\Services\Web\Contracts\ProductServiceInterface;
use App\Services\Web\ProductService;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{
    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService
    )
    {
        parent::__construct();

        $this->categoryService = $categoryService;
        $this->productService = $productService;

        $this->viewData['title'] = 'Trang chu - Sohapay';
    }

    public function index()
    {
        $this->viewData['categories'] = $this->categoryService->getAvailableCategoryForUser()->get();
        $this->viewData['products'] = $this->productService->getAll()->orderByIdDesc()->paginate(20);
        
        return view('web.index', $this->viewData);
    }
}
