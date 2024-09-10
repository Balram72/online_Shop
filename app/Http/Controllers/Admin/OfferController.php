<?php
namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Storage;
use Mail;
use App\Models\Admin\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index()
    {
       $result['data'] = Offer::all();
       return view('admin/offers/offers',$result);
    }
    public function manage_offer(Request $request,$id='')
    {
        if($id>0){
            $arr = Offer::where(['id'=>$id])->get();
            $result['start_date']=$arr['0']->start_date;
            $result['end_date']=$arr['0']->end_date;
            $result['title']=$arr['0']->title;
            $result['image']=$arr['0']->image;
            $result['description']=$arr['0']->description;
            $result['id']=$arr['0']->id;
        }else{
            $result['start_date']="";
            $result['end_date']="";
            $result['title']="";
            $result['image']="";
            $result['description']="";
            $result['id']=0;
        }
        return view('admin/offers/manage_offer',$result);
    }
    public function manage_offer_process(Request $request)
    {
                if($request->post('id')>0){
                    $model=Offer::find($request->post('id'));
                    $msg='Spacial Offer Update';
                }else{
                    $model = new Offer();
                    $msg='Spacial Offer Inserted';
                }

                if($request->hasfile('image')){
                    if($request->post('id')>0){
                        $arrImage = DB::table('offers')->where(['id'=>$request->post('id')])->get();
                        if(Storage::exists('/public/media/offer/'.$arrImage['0']->image)){
                            Storage::delete('/public/media/offer/'.$arrImage['0']->image);
                        };
                    }
                    $image = $request->file('image');
                    $ext = $image ->extension();
                    $image_name= time().'.'.$ext;
                    $image->storeAs('/public/media/offers/',$image_name);
                    $model->image = $image_name;  
                }

            $model->start_date = $request->start_date;
            $model->end_date = $request->end_date;
            $model->title = $request->title;
            $model->description = $request->description;
            $model->status = 1;
            $model->save();
            Session::flash('message',$msg);
            return redirect('admin/offers');
    }

    public function delete($id) {
        $arrImage = DB::table('offers')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/offers/'.$arrImage['0']->image)){
            Storage::delete('/public/media/offers/'.$arrImage['0']->image);
        };
        $model = Offer::find($id);
        $model->delete();
        Session::flash('message','Spacial Offer Deleted');
        return redirect('admin/offers');
    }

    public function status($status,$id) {
        $model = Offer::find($id);
        $model->status=$status;
        $model->save();
        Session::flash('message','Status Updated');
        return redirect('admin/offers');
    }

    public function send($id) {
        $arremail = DB::table('customers')
        ->where('status', 1)
        ->pluck('email')
        ->toArray();
    
    $offer = DB::table('offers')
        ->where('id', $id)
        ->first();
    
    if ($offer) {
        $data = [
            'name' => 'FashionMart',
            'id' => $offer->id,
            'title' => $offer->title,
            'start_date' => $offer->start_date,
            'end_date' => $offer->end_date,
            'description'=>$offer->description,
            'image' => $offer->image
           
        ];
        foreach ($arremail as $email) {
            Mail::send('admin/offers/offermail', $data, function($message) use ($email, $offer) {
                $message->to($email);
                $message->subject($offer->title);
            });
        }
    }
    
    return redirect('admin/offers');

    }
   
}
