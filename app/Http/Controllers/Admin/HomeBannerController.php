<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Storage;


class HomeBannerController extends Controller
{
    
    public function index()
    {
       $result['data'] = HomeBanner::all();
       return view('admin/home_banner/home_banner',$result);
    }
    public function manage_home_banner(Request $request,$id='')
    {
        if($id>0){
            $arr = HomeBanner::where(['id'=>$id])->get();
            $result['image']=$arr['0']->image;
            $result['btn_txt']=$arr['0']->btn_txt;
            $result['btn_link']=$arr['0']->btn_link;
            $result['id']=$arr['0']->id;

        }else{
            $result['image']="";
            $result['btn_txt']="";
            $result['btn_link']="";
            $result['id']="";
        }
        return view('admin/home_banner/manage_home_banner',$result);
    }
    public function manage_home_banner_process(Request $request)
    {
                //     if($request->post('id')>0){  
                //         $image_validation ='required|mimes:png,jpg,jpeg'; 
                //     }
                //     else{  
                //         $image_validation ='mimes:png,jpg,jpeg'; 
                //     }
                // $request->validate([
                //         'image'=>$image_validation,
                // ]);

            if($request->post('id')>0){
                $model=HomeBanner::find($request->post('id'));
                $msg='Banner Update';

            }else{
                $model = new HomeBanner();
                $msg='Banner Inserted';

            }

            if($request->hasfile('image')){
                if($request->post('id')>0){
                        $arrImage = DB::table('home_banners')->where(['id'=>$request->post('id')])->get();
                        if(Storage::exists('/public/media/banner/'.$arrImage['0']->image)){
                            Storage::delete('/public/media/banner/'.$arrImage['0']->image);
                        };
                    }
                $image = $request->file('image');
                $ext = $image ->extension();
                $image_name= time().'.'.$ext;
                $image->storeAs('/public/media/banner/',$image_name);
                $model->image = $image_name;  
            }
            $model->btn_txt = $request->btn_txt;
            $model->btn_link = $request->btn_link;
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/home_banner');
    }

    public function delete($id) {
        $arrImage = DB::table('home_banners')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/banner/'.$arrImage['0']->image)){
            Storage::delete('/public/media/banner/'.$arrImage['0']->image);
        };
        $model = HomeBanner::find($id);
        $model->delete();
        Session::flash('message','Banner Deleted');
        return redirect('admin/home_banner');
    }

    public function status($status,$id) {
        $model = HomeBanner::find($id);
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/home_banner');
    }

}
