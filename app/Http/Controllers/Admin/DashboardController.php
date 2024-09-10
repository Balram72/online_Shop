<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;



class DashboardController extends Controller{
    public function index()
    {
        $total_users = Customer::count();
        $total_earnings = DB::table('orders')
                ->where('payment_status', 'Success')
                ->where('order_status', 3)
                ->sum('total_amt');
        $items_solid = DB::table('orders')
                ->where('order_status', 3)
                ->count();
        $cancle_order = DB::table('orders')
                ->where('order_status', 4)
                ->count();



            return view('admin.dashboard', [
                'total_users' => $total_users,
                'total_earnings' => $total_earnings,
                'items_solid' => $items_solid,
                'cancle_order'=>$cancle_order,
              
             ]);

    }

}
