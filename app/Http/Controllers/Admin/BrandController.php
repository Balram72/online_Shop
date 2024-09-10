<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class BrandController extends Controller
{
    public function index()
    {
       $result['data'] = Brand::all();
       return view('admin/brand/brand',$result);
    }
    public function manage_brand(Request $request,$id='')
    {
        if($id>0){
            $arr = Brand::where(['id'=>$id])->get();
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['is_home']=$arr['0']->is_home;
            $result['is_home_selected']="";
            if($arr['0']->is_home == 1){
                $result['is_home_selected']="checked";
            }

            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;

        }else{
            $result['name']="";
            $result['is_home']="";
            $result['is_home_selected']="";
            $result['image']="";
            $result['status']="";
            $result['id']=0;
        }
        return view('admin/brand/manage_brand',$result);
    }
    public function manage_brand_process(Request $request)
    {            
                    if($request->post('id')>0){  
                        $image_validation ='mimes:png,jpg,jpeg'; 
                    }
                    else{  
                        $image_validation ='mimes:png,jpg,jpeg'; 
                    }
                    $request->validate([
                            'name' => 'required|unique:Brands,name,'.$request->post('id'),
                    ]);
                    if($request->post('id')>0){
                        $model=Brand::find($request->post('id'));
                        $msg='Brand Update';
                    }else{
                        $model = new Brand();
                        $msg='Brand Inserted';
                    }

            if($request->hasfile('image')){
                if($request->post('id')>0){
                    $arrImage = DB::table('brands')->where(['id'=>$request->post('id')])->get();
                    if(Storage::exists('/public/media/BrandsImage/'.$arrImage['0']->image)){
                        Storage::delete('/public/media/BrandsImage/'.$arrImage['0']->image);
                    }
                }
                $image = $request->file('image');
                $ext = $image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('/public/media/BrandsImage',$image_name);
                $model->image = $image_name;  
            }

            $model->name = $request->name;
            $model->is_home = 0;
            if($request->is_home !== null ){
                $model->is_home = 1;
            }   
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/brand');
    }

    public function delete($id) {
            $arrImage = DB::table('brands')->where(['id'=>$id])->get();
            if(Storage::exists('/public/media/BrandsImage/'.$arrImage['0']->image)){
                Storage::delete('/public/media/BrandsImage/'.$arrImage['0']->image);
            }
        
        $model = Brand::find($id);
        $model->delete();
        Session::flash('message','brand Deleted');
        return redirect('admin/brand');
    }

    public function status($status,$id) {
        $result['product'] = DB::table('products')
        ->where(['status'=>1])
        ->where(['slug' => $slug])
        ->get();
        $model->status=$status;
        $model->update();
        Session::flash('message','Status Updated');
        return redirect('admin/brand');
    }
}
