<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function saveCart(Request $request)
    {
        $productId = $request->productId_hidden;
        $quantity = $request->quantity;

        $listProducts = DB::table('tbl_product')->where("id", $productId)->first();

        $data['id'] = $productId;
        $data['name'] = $listProducts->product_name;
        $data['qty'] = $quantity;
        $data['price'] = $listProducts->product_price;
        $data['options']['image'] = $listProducts->product_image;
        $data['options']['size'] = $listProducts->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }

    public function showCart()
    {
        $listCategories = DB::table('tbl_category')->where('status', '1')->orderBy("id", "desc")->get();
        $listBrands = DB::table('tbl_brand')->where('status', '1')->orderBy("id", "desc")->get();
        return view('pages.cart.show_cart')->with("listCategories", $listCategories)->with("listBrands", $listBrands);
    }
}