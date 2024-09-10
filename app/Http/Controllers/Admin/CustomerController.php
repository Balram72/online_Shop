<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
       $result['data'] = Customer::all();
       return view('admin/customer/customer',$result);
    }


    public function show(Request $request,$id='')
    {
        $arr = Customer::where(['id'=>$id])->get();
        $result['customer_list'] = $arr['0'];
        return view('admin/customer/show_customer',$result);
    }

    public function status($status,$id) {
        $model = Customer::find($id);
        if (!$model) {
            Session::flash('message', 'Customer found');
            return redirect('admin/customer');
        }
        $model->status=$status;
        $model->save();
        Session::flash('message',' Customer Status Updated');
        return redirect('admin/customer');
    }
}
