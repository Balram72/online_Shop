<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Tax;
use App\Models\Admin\Size;
use Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
       $result['data'] =Product::all();
       return view('admin/product/product',$result);
    }
    public function manage_product(Request $request,$id='')
    {
        if($id>0){
            $arr = Product::where(['id'=>$id])->get();

            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']=$arr['0']->slug;
            $result['brand']=$arr['0']->brand;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;
            $result['lead_time']=$arr['0']->lead_time;
            $result['tax_id']=$arr['0']->tax_id;
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
            
            $result['productAttrArr']=DB::table('products_attr')->where(['products_id'=>$id])->get();

            $productImagesArr=DB::table('product_images')->where(['products_id'=>$id])->get();

            if(!isset($productImagesArr[0])){
                $result['productImagesArr'][0]['id'] = '';
                $result['productImagesArr'][0]['images'] = '';
            }else{
                $result['productImagesArr'] = $productImagesArr;
            }
            // echo'<pre>';
            // print_r($result['productAttrArr']);
            // die();

        }else{
            $result['category_id']="";
            $result['name']="";
            $result['image']="";
            $result['slug']="";
            $result['brand']="";
            $result['model']="";
            $result['short_desc']="";
            $result['desc']="";
            $result['keywords']="";
            $result['technical_specification']="";
            $result['uses']="";
            $result['warranty']="";
            $result['lead_time']="";
            $result['tax_id']="";
            $result['is_promo']="";
            $result['is_featured']="";
            $result['is_discounted']="";
            $result['is_tranding']="";
            $result['status']="";
            $result['id']=0;

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['products_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';
            $result['productImagesArr'][0]['id'] = '';
            $result['productImagesArr'][0]['images'] = '';
            // echo'<pre>';
            // print_r($result['productAttrArr']);
            // die();

        }

        $result['taxs'] = Tax::where('status', 1)->get();
        $result['category'] = Category::where('status', 1)->get();
        $result['colors'] = Color::where('status', 1)->get();
        $result['sizes'] = Size::where('status', 1)->get();
        $result['brands']=DB::table('brands')->where(['status'=>1])->get();


        return view('admin/product/manage_product',$result);
    }
    public function manage_product_process(Request $request)
    {
            // echo'<pre>';
            //  print_r($request->post());
            // die();
                if($request->post('id')>0){  
                    $image_validation ='mimes:png,jpg,jpeg'; 
                }
                else{  
                    $image_validation ='required|mimes:png,jpg,jpeg'; 
                }
                $request->validate([
                        'name'=>'required',
                        'image'=>$image_validation,
                        'slug' => 'required|unique:products,slug,'.$request->post('id'),
                        'attr_image.*' =>'mimes:jpg,jpeg,png',
                        'images.*' =>'mimes:jpg,jpeg,png'  
                ]);

                $paidArr = $request->paid;
                $skuArr = $request->sku;
                $mrpArr = $request->mrp;
                $priceArr = $request->price;
                $qtyArr = $request->qty;
                $size_idArr = $request->size_id;
                $color_idArr = $request->color_id;

                foreach($skuArr as $key=>$val){
                    $check = DB::table('products_attr')->
                    where('sku','=',$skuArr[$key])->
                    where('id','!=',$paidArr[$key])->get();

                    if(isset($check[0])){
                        Session::flash('sku_error',$skuArr[$key].'SKU Already Used');
                        return redirect(request()->headers->get('referer'));
                    }
                }

            if($request->post('id')>0){
                $model=Product::find($request->post('id'));
                $msg='Product Update';
            }else{
                $model = new Product();
                $msg='Product Inserted';
            }

            if($request->hasfile('image')){
                if($request->post('id')>0){
                    $arrImage = DB::table('products')->where(['id'=>$request->post('id')])->get();
                    if(Storage::exists('/public/media/'.$arrImage['0']->image)){
                            Storage::delete('/public/media/'.$arrImage['0']->image);
                    };
                }
                $image = $request->file('image');
                $ext = $image ->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('/public/media',$image_name);
                $model->image = $image_name;  
            }

            $model->category_id = $request->category_id;
            $model->name = $request->name;
            $model->slug = $request->slug;
            $model->brand = $request->brand;  
            $model->model = $request->model;
            $model->short_desc = $request->short_desc;  
            $model->desc = $request->desc;
            $model->keywords = $request->keywords;
            $model->technical_specification = $request->technical_specification;  
            $model->uses = $request->uses;
            $model->warranty = $request->warranty;  

            $model->lead_time = $request->lead_time;  
            $model->tax_id = $request->tax_id;  
            $model->is_promo = $request->is_promo;  
            $model->is_featured = $request->is_featured;  
            $model->is_discounted = $request->is_discounted;  
            $model->is_tranding = $request->is_tranding;  

            $model->status = 1;
            $model->save();
            $pid = $model->id;
            /*Product Attr Start*/
                foreach($skuArr as $key=>$val){
                    $productAttrArr = [];
                    $productAttrArr['products_id'] = $pid;
                    $productAttrArr['sku'] = $skuArr[$key];
                    $productAttrArr['mrp'] =(int)$mrpArr[$key];
                    $productAttrArr['price'] =(int)$priceArr[$key];
                    $productAttrArr['qty'] =(int)$qtyArr[$key];

                    if($size_idArr[$key]==''){
                        $productAttrArr['size_id'] = 0;
                    }else{
                        $productAttrArr['size_id'] = $size_idArr[$key];
                    }
                    if($color_idArr[$key]==''){
                        $productAttrArr['color_id'] = 0;
                    }else{
                        $productAttrArr['color_id'] = $color_idArr[$key];
                    }

                    if($request->hasFile("attr_image.$key")){
                        if($paidArr[$key]!=''){
                            $arrImage = DB::table('products_attr')->where(['id'=>$paidArr[$key]])->get();
                            if(Storage::exists('/public/media/productAttrImage/'.$arrImage['0'] ->attr_image)){
                                   Storage::delete('/public/media/productAttrImage/'.$arrImage['0']->attr_image);
                            };
                        }
                        $rand =rand('111111111','999999999');
                        $attr_image = $request->file("attr_image.$key");
                        $ext = $attr_image->extension();
                        $image_name = $rand.'.'.$ext;
                        $request->file("attr_image.$key")->storeAs('/public/media/productAttrImage',$image_name);
                        $productAttrArr['attr_image']=$image_name;
                    }
                    if($paidArr[$key]!=''){
                        //update Code
                        DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);  
                    }else{
                        //Insert Code
                        DB::table('products_attr')->insert($productAttrArr);  
                    }

                   
                }
            /*Product Attr End*/

            /*Product Images Start*/
            $piidArr = $request->piid;
            foreach($piidArr as $key=>$val){
                $productImageArr['products_id'] = $pid;
                if($request->hasFile("images.$key")){
                    if($piidArr[$key]!=''){
                        $arrImage = DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                        if(Storage::exists('/public/media/productsMultipalImage/'.$arrImage['0']->images)){
                            Storage::delete('/public/media/productsMultipalImage/'.$arrImage['0']->images);
                        }
                    }
                    $rand =rand('111111111','999999999');
                    $images = $request->file("images.$key");
                    $ext = $images ->extension();
                    $image_name = $rand.'.'.$ext;
                    $request->file("images.$key")->storeAs('/public/media/productsMultipalImage',$image_name);
                    $productImageArr['images']=$image_name;  
                    
                    if($piidArr[$key]!=''){
                        //update Code
                        DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);  
                    }else{
                        //Insert Code
                        DB::table('product_images')->insert($productImageArr);  
                    }

                }

            }
            /*Product Images End*/

            Session::flash('message',$msg);
            return redirect('admin/product');
    }

    public function delete($id) {
        $model = Product::find($id);
        $model-> delete();
        Session::flash('message','Product Deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request,$paid,$pid) {

            $arrImage = DB::table('products_attr')->where(['id'=>$paid])->get();

            if(Storage::exists('/public/media/productAttrImage/'.$arrImage['0']->attr_image)){
                    Storage::delete('/public/media/productAttrImage/'.$arrImage['0']->attr_image);
            };

        DB::table('products_attr')->where(['id'=>$paid])->delete();
        Session::flash('message','Product Attributed Deleted');
        return redirect('admin/product/manage_product/'.$pid);
    }
    public function product_images_delete(Request $request,$paid,$pid) {

        $arrImage = DB::table('product_images')->where(['id'=>$paid])->get();
         if(Storage::exists('/public/media/productsMultipalImage/'.$arrImage['0']->images)){
                Storage::delete('/public/media/productsMultipalImage/'.$arrImage['0']->images);
          };
        DB::table('product_images')->where(['id'=>$paid])->delete();
        Session::flash('message','Product Image Deleted');
        return redirect('admin/product/manage_product/'.$pid);
    }
    public function status($status,$id) {
        $model =Product::find($id);
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/product');
    }

}
