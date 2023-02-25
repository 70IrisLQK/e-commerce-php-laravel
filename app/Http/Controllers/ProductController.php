<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session as FacadesSession;

class ProductController extends Controller
{
    public function authLogin()
    {
        $admin_id = FacadesSession::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function listProduct()
    {
        $this->authLogin();
        $listProducts = DB::table('tbl_product')->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.category_id')->join('tbl_brand', 'tbl_brand.id', '=', 'tbl_product.brand_id')->select('tbl_product.*', 'tbl_category.category_name', 'tbl_brand.brand_name')->orderBy('id', 'asc')->get();
        $managerProducts = view('admin.list_product')->with('listProducts', $listProducts);
        return view('admin_layout')->with("admin.list_product", $managerProducts);
    }

    public function createProduct()
    {
        $this->authLogin();
        $listCategories = DB::table('tbl_category')->orderby('id', 'desc')->get();
        $listBrands = DB::table('tbl_brand')->orderby('id', 'desc')->get();

        return view('admin.create_product')->with('listCategories', $listCategories)->with('listBrands', $listBrands);
    }

    public function saveProduct(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $data['status'] = $request->product_status;

        $getImage = $request->file('product_image');
        if ($getImage) {
            $uuid = Str::uuid()->toString();

            $newImage = $uuid . '.' . $getImage->getClientOriginalExtension();
            $getImage->move(public_path('/uploads/product'), $newImage);
            $data['product_image'] = $newImage;
            DB::table('tbl_product')->insert($data);
            $request->session()->put('message', "Create Product successfully");
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        $request->session()->put('message', "Create Product successfully");
        return Redirect::to('add-product');
    }

    public function editProduct(Request $request, $productId)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_description'] = $request->product_description;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;

        $getImage = $request->file('product_image');
        if ($getImage) {
            $uuid = Str::uuid()->toString();

            $newImage = $uuid . '.' . $getImage->getClientOriginalExtension();
            $getImage->move(public_path('/uploads/product'), $newImage);
            $data['product_image'] = $newImage;
            DB::table('tbl_product')->where("id", $productId)->update($data);
            $request->session()->put('message', "Create Product successfully");
            return Redirect::to('products');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->where("id", $productId)->update($data);
        $request->session()->put('message', "Update Product successfully");
        return Redirect::to('products');
    }

    public function activeProduct(Request $request, $productId)
    {
        DB::table('tbl_product')->where('id', $productId)->update(["status" => 1]);
        $request->session()->put('message', "Update Status Product successfully");
        return Redirect::to('products');
    }
    public function inactiveProduct(Request $request, $productId)
    {
        DB::table('tbl_product')->where('id', $productId)->update(["status" => 0]);
        $request->session()->put('message', "Update Status Product successfully");
        return Redirect::to('products');
    }
    public function deleteProduct(Request $request, $productId)
    {
        DB::table('tbl_product')->where('id', $productId)->delete($productId);
        $request->session()->put('message', "Delete Product successfully");
        return Redirect::to('products');
    }
    public function updateProduct($productId)
    {
        $this->authLogin();
        $listProducts = DB::table('tbl_product')->where('id', $productId)->get();
        $listCategories = DB::table('tbl_category')->get();
        $listBrands = DB::table('tbl_brand')->get();
        $managerProduct = view('admin.edit_product')->with('listBrands', $listBrands)->with("listProducts", $listProducts)->with('listCategories', $listCategories)->with('listBrands', $listBrands);
        return view('admin_layout')->with("managerProduct", $managerProduct);
    }

    //End function admin
    public function productDetail($productId)
    {
        $listCategories = DB::table('tbl_category')->where('status', '1')->orderBy('id', 'desc')->get();
        $listBrands = DB::table('tbl_brand')->where('status', '1')->orderBy('id', 'desc')->get();
        $listProduct = DB::table('tbl_product')->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.category_id')->join('tbl_brand', 'tbl_brand.id', '=', 'tbl_product.brand_id')->where('tbl_product.id', $productId)->get();

        foreach ($listProduct as $key => $value) {
            $categoryId = $value->category_id;
        }
        $listRecommendProduct = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.category_id', $categoryId)
            ->get();
        return view('pages.product.show_detail')->with('listCategories', $listCategories)->with('listBrands', $listBrands)->with('listProduct', $listProduct)->with('listRecommendProduct', $listRecommendProduct);
    }
}