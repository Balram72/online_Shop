<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
                return redirect('admin/dashboard');
        }else{
            return view('admin.login');

        }
    }
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        // $request = Admin::where(['email'=>$email,'password'=>$password])->first();
        $request = Admin::where(['email'=>$email])->first();
        if($request){
            if(Hash::check($password,$request->password)){
                Session::put('ADMIN_LOGIN', true);
                Session::put('ADMIN_ID', $request->id);
                return redirect('admin/dashboard');
            }else{
                Session::flash('error', 'Please Enter Correct Password');
                return redirect('admin');
            }   
        }else{
           Session::flash('error', 'Please Enter Valid Login Details');
           return redirect('admin');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
