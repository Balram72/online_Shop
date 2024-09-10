<?php
namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
       $result['data'] = Tax::all();
       return view('admin/tax/tax',$result);
    }
    public function manage_tax(Request $request,$id='')
    {
        if($id>0){
            $arr = Tax::where(['id'=>$id])->get();
            $result['tax_desc']=$arr['0']->tax_desc;
            $result['tax_value']=$arr['0']->tax_value;
            $result['id']=$arr['0']->id;

        }else{
            $result['tax_desc']="";
            $result['tax_value']="";
            $result['id']=0;
        }
        return view('admin/tax/manage_tax',$result);
    }
    public function manage_tax_process(Request $request)
    {
                $request->validate([
                        'tax_value' => 'required|unique:taxs,tax_value,'.$request->post('id'),
                ]);

            if($request->post('id')>0){
                $model=Tax::find($request->post('id'));
                $msg='Tax Update';
            }else{
                $model = new tax();
                $msg='Tax Inserted';
            }
            $model->tax_desc = $request->tax_desc;
            $model->tax_value = $request->tax_value;
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/tax');
    }

    public function delete($id) {
        $model = Tax::find($id);
        $model->delete();
        Session::flash('message','Tax Deleted');
        return redirect('admin/tax');
    }

    public function status($status,$id) {
        $model = Tax::find($id);
        if (!$model) {
            Session::flash('message', 'Tax not found');
            return redirect('admin/tax');
        }
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/tax');
    }
}
