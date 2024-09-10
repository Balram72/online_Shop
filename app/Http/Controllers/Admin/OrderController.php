<?php
namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $result['orders'] = DB::table('orders')
        ->select('orders.*','orders_status.order_status')
        ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
        ->get();
        return view('admin/order/order',$result); 
    }

    public function order_detail(Request $request,$id){
        $result['order_details'] = DB::table('order_details')
        ->select(
            'orders.*',
            'order_details.price','order_details.qty',
            'products.name as pname', 
            'products_attr.attr_image',
            'sizes.size',
            'colors.color',
            'orders_status.order_status'
        )
        ->leftJoin('orders','orders.id','=','order_details.orders_id')
        ->leftJoin('products_attr','products_attr.id','=','order_details.products_attr_id')
        ->leftJoin('products','products.id','=','products_attr.products_id')
        ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
        ->leftJoin('colors','colors.id','=','products_attr.color_id')  
        ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
        ->where(['orders.id'=>$id])
        ->get();

          
        $result['orders_statu']=
            DB::table('orders_status')  
            ->select(
                'orders_status.id',
                'orders_status.order_status as orders_status',
              )
            ->get();
        $result['payment_status'] = ['Pending','Success','Fail'];
        return view('admin/order/order_detail',$result);   
    } 
    
    public function update_payment_status(Request $request,$status,$id){
        DB::table('orders')
       ->where(['id'=>$id])
       ->update(['payment_status'=>$status]);   
      return  redirect('admin/order/order_detail/'.$id);
    } 

    public function update_order_status(Request $request,$status,$id){
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['order_status'=>$status]);  
        return  redirect('admin/order/order_detail/'.$id);
    } 

    public function update_track_detail(Request $request,$id)
    {
        $track_details=$request->post('track_details');
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['track_details'=>$track_details]);
        return redirect('/admin/order/order_detail/'.$id);
    } 


    public function BillGenerate(Request $request,$id){
        $result['order_details'] = DB::table('order_details')
        ->select(
            'orders.*',
            'order_details.price','order_details.qty',
            'products.name as pname', 
            'products_attr.attr_image',
            'sizes.size',
            'colors.color',
            'orders_status.order_status'
        )
        ->leftJoin('orders','orders.id','=','order_details.orders_id')
        ->leftJoin('products_attr','products_attr.id','=','order_details.products_attr_id')
        ->leftJoin('products','products.id','=','products_attr.products_id')
        ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
        ->leftJoin('colors','colors.id','=','products_attr.color_id')  
        ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
        ->where(['orders.id'=>$id])
        ->get();

        $pdf = PDF::loadView('admin/order/bill',$result);
        return $pdf->download('Bill.pdf'); 
    }

   
}
