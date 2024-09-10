<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
       $result['data'] = Color::all();
       return view('admin/color/color',$result);
    }
    public function manage_color(Request $request,$id='')
    {
        if($id>0){
            $arr = Color::where(['id'=>$id])->get();
            $result['color']=$arr['0']->color;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;

        }else{
            $result['color']="";
            $result['status']="";
            $result['id']=0;
        }
        return view('admin/color/manage_color',$result);
    }
    public function manage_color_process(Request $request)
    {
                $request->validate([
                        'color' => 'required|unique:colors,color,'.$request->post('id'),
                ]);
            if($request->post('id')>0){
                $model=Color::find($request->post('id'));
                $msg='Color Update';
            }else{
                $model = new Color();
                $msg='Color Inserted';
            }
            $model->color = $request->color;
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/color');
    }

    public function delete($id) {
        $model = Color::find($id);
        $model->delete();
        Session::flash('message','color Deleted');
        return redirect('admin/color');
    }

    public function status($status,$id) {
        $model = Color::find($id);
        if (!$model) {
            Session::flash('message', 'color not found');
            return redirect('admin/color');
        }
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/color');
    }
}
