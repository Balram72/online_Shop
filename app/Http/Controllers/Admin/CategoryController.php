<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;


class CategoryController extends Controller
{
    
    public function index()
    {
       $result['data'] = Category::all();
       return view('admin/category/category',$result);
    }
    public function manage_category(Request $request,$id='')
    {
        if($id>0){
            $arr = Category::where(['id'=>$id])->get();
            $result['category_name']=$arr['0']->category_name;
            $result['category_slug']=$arr['0']->category_slug;
            $result['parent_category_id']=$arr['0']->parent_category_id;
            $result['category_image']=$arr['0']->category_image;
            $result['is_home']=$arr['0']->is_home;

            $result['is_home_selected']="";
            if($arr['0']->is_home == 1){
                $result['is_home_selected']="checked";
            }

            $result['id']=$arr['0']->id;
            $result['category'] = Category::where('status', 1)->where('id','!=',$id)->get();
        }else{
            $result['category_name']="";
            $result['is_home']="";
            $result['is_home_selected']="";
            $result['category_slug']="";
            $result['parent_category_id']="";
            $result['category_image']="";
            $result['id']=0;
            $result['category'] = Category::where('status', 1)->get();

        }
        return view('admin/category/manage_category',$result);
    }
    public function manage_category_process(Request $request)
    {
                $request->validate([
                        'category_name'=>'required',
                        'category_image'=>'mimes:png,jpg,jpeg',
                        'category_slug' => 'required|unique:categories,category_slug,'.$request->post('id'),
                ]);

            if($request->post('id')>0){
                $model=Category::find($request->post('id'));
                $msg='Category Update';

            }else{
                $model = new Category();
                $msg='Category Inserted';

            }

            if($request->hasfile('category_image')){
                if($request->post('id')>0){
                        $arrImage = DB::table('categories')->where(['id'=>$request->post('id')])->get();
                        if(Storage::exists('/public/media/category_image/'.$arrImage['0']->category_image)){
                            Storage::delete('/public/media/category_image/'.$arrImage['0']->category_image);
                        };
                    }
                $image = $request->file('category_image');
                $ext = $image ->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('/public/media/category_image/',$image_name);
                $model->category_image = $image_name;  
            }
            $model->category_name = $request->category_name;
            $model->category_slug = $request->category_slug;
            $model->parent_category_id = $request->parent_category_id;
            $model->is_home = 0;
            if($request->is_home !== null ){
                $model->is_home = 1;
            }
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/category');
    }

    public function delete($id) {
        $arrImage = DB::table('categories')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/category_image/'.$arrImage['0']->category_image)){
            Storage::delete('/public/media/category_image/'.$arrImage['0']->category_image);
        };
        $model = Category::find($id);
        $model->delete();
        Session::flash('message','Category Deleted');
        return redirect('admin/category');
    }

    public function status($status,$id) {
        $model = Category::find($id);
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/category');
    }

}
