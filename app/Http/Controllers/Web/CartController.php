<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\ProductRequest;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\Web\Contracts\CategoryServiceInterface;
use App\Services\Web\Contracts\ProductServiceInterface;
use App\Services\Web\Contracts\ProductImageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class CartController extends BaseController
{
    public function __construct(
        ProductServiceInterface $productService,
        ProductImageServiceInterface $productImageService,
        CategoryServiceInterface $categoryService
    )
    {
        parent::__construct();

        $this->productService = $productService;
        $this->productImageService = $productImageService;
        $this->categoryService = $categoryService;

        $this->viewData['title'] = "Giỏ hàng";
    }

    public function putCartToSession($cart)
    {
        Session::put('cart', $cart);
    }

    public function getCartFromSession()
    {
        return Session::get('cart', []);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        $inputs = $request->all();

        $cart = $this->getCartFromSession();

        $productId = $inputs['product_id'];
        $productQty = (int) $inputs['product_qty'];

        if(!isset($cart[$productId])) {
            $cart[$productId] = 0;
        }

        $cart[$productId] += $productQty;

        $this->putCartToSession($cart);

        return response()->json(['success' => true, 'cartCount' => count($cart)]);
    }

    public function deleteItem(Request $request)
    {
        $inputs = $request->all();

        $cart = $this->getCartFromSession();
        unset($cart[$inputs['product_id']]);

        $this->putCartToSession($cart);

        return response()->json(['success' => true]);
    }

    public function updateItem(Request $request)
    {
        $inputs = $request->all();

        if((int) $inputs['product_qty'] > 0) {
            $cart = $this->getCartFromSession();
            $cart[$inputs['product_id']] = (int) $inputs['product_qty'];

            $this->putCartToSession($cart);
        }

        return response()->json(['success' => true]);
    }

    public function getItem(Request $request)
    {
        $cart = $this->getCartFromSession();

        $products = [];
        $totalPrice = 0;

        foreach($cart as $productId => $productQty) {
            $product = $this->productService->find($productId);
            if($product) {
                $product->qty = $productQty;

                $totalPrice += $product->price * $productQty;
                $products[] = $product;
            }
        }

        $this->viewData['products'] = $products;
        $this->viewData['totalPrice'] = $totalPrice;

        return view('web.cart.lists', $this->viewData);
    }

    public function getOrder(Request $request)
    {
        $cart = $this->getCartFromSession();
        $products = [];
        $totalPrice = 0;

        foreach($cart as $productId => $productQty) {
            $product = $this->productService->find($productId);
            if($product) {
                $product->qty = $productQty;
                $product->totalPrice = $productQty * $product->price;

                $totalPrice += $product->price * $productQty;
                $products[] = $product;
            }
        }

        $this->viewData['totalPrice'] = $totalPrice;
        $this->viewData['products'] = $products;

        return view('web.cart.order', $this->viewData);
    }

    public function placeOrder(Request $request)
    {
        $inputs = $request->only('customer_name', 'customer_address', 'customer_tel', 'customer_note');

        $order = Order::create($inputs);
        $cart = $this->getCartFromSession();

        foreach($cart as $productId => $productQty) {
            $product = $this->productService->find($productId);

            if($product) {
                OrderItem::create(
                    [
                        'product_id' => $productId,
                        'qty' => $productQty,
                        'order_id' => $order->id,
                        'price' => $product->price,
                    ]
                );
            }
        }

        Session::forget('cart');

        return redirect()->route('home')
            ->with('success', 'Đặt hàng thành công!');
    }
}
