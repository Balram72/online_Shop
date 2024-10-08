<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
       $result['data'] = Size::all();
       return view('admin/size/size',$result);
    }
    public function manage_size(Request $request,$id='')
    {
        if($id>0){
            $arr = Size::where(['id'=>$id])->get();
            $result['size']=$arr['0']->size;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;

        }else{
            $result['size']="";
            $result['status']="";
            $result['id']=0;
        }
        return view('admin/size/manage_size',$result);
    }
    public function manage_size_process(Request $request)
    {
                $request->validate([
                        'size' => 'required|unique:sizes,size,'.$request->post('id'),
                ]);
            if($request->post('id')>0){
                $model=Size::find($request->post('id'));
                $msg='Size Update';
            }else{
                $model = new Size();
                $msg='Size Inserted';
            }
            $model->size = $request->size;
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/size');
    }

    public function delete($id) {
        $model = Size::find($id);
        $model->delete();
        Session::flash('message','Size Deleted');
        return redirect('admin/size');
    }

    public function status($status,$id) {
        $model = Size::find($id);
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/size');
    }
}
