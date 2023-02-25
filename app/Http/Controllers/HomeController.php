<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $listCategories = DB::table('tbl_category')->where('status', '1')->orderBy('id', 'desc')->get();
        $listBrands = DB::table('tbl_brand')->where('status', '1')->orderBy('id', 'desc')->get();
        $listProducts = DB::table('tbl_product')->where('status', '1')->orderBy('id', 'desc')->limit('6')->get();
        return view('pages.home')->with('listCategories', $listCategories)->with('listBrands', $listBrands)->with('listProducts', $listProducts);
    }
}