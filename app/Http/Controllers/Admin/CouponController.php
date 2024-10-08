<?php
namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Coupon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CouponController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $result['data'] = Coupon::all();
       return view('admin/coupon/coupon',$result);
    }
    public function manage_coupon(Request $request,$id='')
    {
        if($id>0){
            $arr = Coupon::where(['id'=>$id])->get();
            $result['title']=$arr['0']->title;
            $result['code']=$arr['0']->code;
            $result['value']=$arr['0']->value;
            $result['type']=$arr['0']->type;
            $result['min_order_amt']=$arr['0']->min_order_amt;
            $result['is_one_time']=$arr['0']->is_one_time;
            $result['id']=$arr['0']->id;

        }else{
            $result['title']="";
            $result['code']="";
            $result['value']="";
            $result['type']=$arr['0']="";
            $result['min_order_amt']="";
            $result['is_one_time']="";
            $result['id']=0;
        }
        return view('admin/coupon/manage_coupon',$result);
    }
    public function manage_coupon_process(Request $request)
    {
                $request->validate([
                        'title'=>'required',
                        'code' => 'required|unique:coupons,code,'.$request->post('id'),
                        'value'=>'required',
                ]);
            if($request->post('id')>0){
                $model=Coupon::find($request->post('id'));
                $msg='Coupon Update';
            }else{
                $model = new Coupon();
                $msg='Coupon Inserted';
                $model->status = 1;
            }
            $model->title = $request->title;
            $model->code = $request->code;
            $model->value = $request->value;
            $model->type = $request->type;
            $model->min_order_amt = $request->min_order_amt;
            $model->is_one_time = $request->is_one_time;
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/coupon');
    }

    public function delete($id) {
        $model = Coupon::find($id);
        $model->delete();
        Session::flash('message','Coupon Deleted');
        return redirect('admin/coupon');
    }

    public function status($status,$id) {
        $model = Coupon::find($id);
        if (!$model) {
            Session::flash('message', 'Coupon not found');
            return redirect('admin/coupon');
        }
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/coupon');
    }
}
