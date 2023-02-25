<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

class CategoryController extends Controller
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

    public function createCategory()
    {
        $this->authLogin();
        return view('admin.create_category');
    }
    public function listCategories()
    {
        $this->authLogin();
        $listCategories = DB::table('tbl_category')->get();
        $managerCategory = view('admin.list_category')->with('listCategories', $listCategories);
        return view('admin_layout')->with('admin.list_category', $managerCategory);
    }
    public function saveCategory(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_desc;
        $data['status'] = $request->category_status;

        DB::table('tbl_category')->insert($data);
        $request->session()->put('message', "Add category successfully");
        return Redirect::to('add-category');
    }

    public function activeCategory(Request $request, $categoryId)
    {
        DB::table('tbl_category')->where('id', $categoryId)->update(['status' => 0]);
        $request->session()->put('message', "Update status category successfully");
        return Redirect::to('categories');
    }

    public function inactiveCategory(Request $request, $categoryId)
    {
        DB::table('tbl_category')->where('id', $categoryId)->update(['status' => 1]);
        $request->session()->put('message', "Update status category successfully");
        return Redirect::to('categories');
    }
    public function updateCategory(Request $request, $categoryId)
    {
        $this->authLogin();
        $listCategories = DB::table('tbl_category')->get()->where('id', $categoryId);
        $managerCategory = view('admin.edit_category')->with('listCategories', $listCategories);
        return view('admin_layout')->with('admin.list_category', $managerCategory);
    }
    public function editCategory(Request $request, $categoryId)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        DB::table("tbl_category")->where('id', $categoryId)->update($data);
        $request->session()->put('message', "Update category successfully");
        return Redirect::to('categories');
    }
    public function deleteCategory(Request $request, $categoryId)
    {
        DB::table('tbl_category')->where('id', $categoryId)->delete($categoryId);
        $request->session()->put('message', "Delete category successfully");
        return Redirect::to('categories');
    }

    //Function Admin category
    public function showCategoryHome($categoryId)
    {
        $listCategories = DB::table('tbl_category')->where('status', '1')->orderBy("id", "desc")->get();
        $listBrands = DB::table('tbl_brand')->where('status', '1')->orderBy("id", "desc")->get();
        $listProductByCategory = DB::table('tbl_product')->join('tbl_category', 'tbl_category.id', "=", 'tbl_product.category_id')->where("tbl_product.category_id", $categoryId)->get();
        $categoryName = DB::table('tbl_category')->where("id", $categoryId)->limit("1")->get();
        return view('pages.category.show_category')->with("listCategories", $listCategories)->with("listBrands", $listBrands)->with('listProductByCategory', $listProductByCategory)->with('categoryName', $categoryName);
    }
}