<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

class BrandController extends Controller
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
    public function listBrand()
    {
        $this->authLogin();
        $listBrands = DB::table('tbl_brand')->get();
        $managerBrands = view('admin.list_brand')->with('listBrands', $listBrands);
        return view('admin_layout')->with('admin.list_brand', $managerBrands);
    }

    public function addBrand()
    {
        $this->authLogin();
        return view('admin.create_brand');
    }
    public function saveBrand(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->brand_description;
        $data['status'] = $request->status;

        DB::table('tbl_brand')->insert($data);
        $request->session()->put('message', "Add brand successfully");
        return view('admin.create_brand');
    }
    public function inactiveBrand(Request $request, $brandId)
    {
        DB::table('tbl_brand')->where('id', $brandId)->update(['status' => 1]);
        $request->session()->put('message', "Update status successfully");
        return Redirect::to('brands');
    }

    public function activeBrand(Request $request, $brandId)
    {
        DB::table('tbl_brand')->where('id', $brandId)->update(['status' => 0]);
        $request->session()->put('message', "Update status successfully");
        return Redirect::to('brands');
    }

    public function deleteBrand(Request $request, $brandId)
    {
        DB::table('tbl_brand')->where('id', $brandId)->delete($brandId);
        $request->session()->put('message', "Delete brand successfully");
        return Redirect::to('brands');
    }

    public function updateBrand($brandId)
    {
        $this->authLogin();
        $listBrands = DB::table('tbl_brand')->where('id', $brandId)->get();
        $managerBrands = view('admin.edit_brand')->with('listBrands', $listBrands);
        return view('admin_layout')->with('admin.edit_brand', $managerBrands);
    }

    public function editBrand(Request $request, $brandId)
    {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_description'] = $request->brand_description;

        DB::table('tbl_brand')->where("id", $brandId)->update($data);
        $request->session()->put('message', "Update brand successfully");
        return Redirect::to('brands');
    }

    //End function admin
    public function showBrandHome($brandId)
    {
        $listCategories = DB::table("tbl_category")->where('status', '1')->orderBy('id', 'desc')->get();
        $listBrands = DB::table("tbl_brand")->where('status', '1')->orderBy('id', 'desc')->get();
        $listProductByBrand = DB::table('tbl_product')->join('tbl_brand', 'tbl_brand.id', '=', 'tbl_product.brand_id')->where('tbl_product.brand_id', $brandId)->get();
        $brandName = DB::table('tbl_brand')->where('id', $brandId)->limit('1')->get();
        return view('pages.brand.show_brand')->with('listCategories', $listCategories)->with('listBrands', $listBrands)->with('listProductByBrand', $listProductByBrand)->with('brandName', $brandName);
    }
}