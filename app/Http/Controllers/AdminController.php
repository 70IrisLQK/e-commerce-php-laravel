<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

session_start();

class AdminController extends Controller
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
    public function index(): View
    {
        return view('admin.login');
    }
    public function showDashboard(): View
    {
        $this->authLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $this->authLogin();
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();

        if ($result) {
            $request->session()->put('admin_name', $result->admin_name);
            $request->session()->put('admin_id', $result->id);
            return Redirect::to('/dashboard');
        } else {
            $request->session()->put('message', "Password incorrect.");
            return Redirect::to('/admin');
        }

        return view('admin.dashboard');
    }
    public function logout(Request $request)
    {
        $this->authLogin();
        $request->session()->put('admin_name', null);
        $request->session()->put('admin_id', null);
        return view('admin.login');
    }
}