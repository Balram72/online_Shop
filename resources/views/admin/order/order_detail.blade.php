@extends('admin/layout')
@section('page_title','Order Details')
@section('order_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-6 " >
        <h1 style="margin-bottom:20px;">Order - {{  $order_details[0]->id  }}</h1> 
    </div>
    <div class="col-md-6 text-right">
      <a href="{{ url('admin/order/BillGenerate')}}/{{ $order_details[0]->id }}">
          <button type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>&nbsp;Generate Bill</button>
      </a>
    </div>
    <div class="col-md-12 mt-10 whitebg">
        <div class="row">
            <div class="col-md-6">
                <div class="order_detail">
                  <h3>Details Address</h3>
                  {{ $order_details[0]->name }}<br/>{{ $order_details[0]->email }}<br/>{{ $order_details[0]->mobile }}<br/>
                  {{ $order_details[0]->address }}<br/>{{ $order_details[0]->city }}<br/>{{ $order_details[0]->state }}<br/>
                  {{ $order_details[0]->pincode }}<br/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="order_detail" style="float:right">
                  <h3>Order Address</h3>
                    Order Status :{{ $order_details[0]->order_status }}<br/>
                    Payment Type :{{ $order_details[0]->payment_type }}<br/>
                    Payment Status :{{ $order_details[0]->payment_status }}<br/>
                    <?php
                      if($order_details[0]->payment_id!=''){
                        echo 'Payment ID :'.$order_details[0]->payment_id .'<br/>';
                      }
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="cart-view-area">
                  <div class="cart-view-table">
                      <div class="table-responsive">
                         <table class="table order_detail">
                           <thead>
                             <tr>
                               <th>Product</th>
                               <th>Product Image</th>
                               <th>Color</th>
                               <th>Size</th>
                               <th>Price</th>
                               <th>qty</th>
                               <th>Total</th>                      
                             </tr>
                           </thead>
                           <tbody>
                            @php
                              $totalAmt = 0;
                            @endphp
                            @foreach ($order_details as $list)
                              @php
                              $totalAmt = $totalAmt+($list->price*$list->qty);
                              @endphp
                              <tr>
                                <td>{{  $list->pname  }}</td>
                                <td ><img src="{{asset('storage/media/productAttrImage/'.$list->attr_image)}}" alt="No Image"></td>
                                <td>{{  $list->color  }}</td>
                                <td>{{  $list->size  }}</td>
                                <td>Rs.{{  $list->price  }}</td>
                                <td>{{  $list->qty  }}</td>
                                <td>Rs.{{  $list->price*$list->qty  }}</td>                      
                              </tr>                    
                            @endforeach
                            <tr>
                              <td colspan="5">&nbsp;</td> 
                              <td><b>Total Price</b></td> 
                              <td><b>Rs.{{ $totalAmt  }}</b></td>                      
                            </tr>  
                              <?php
                                if ($order_details[0]->coupon_value>0) {
                                  echo '<td colspan="5">&nbsp;</td> 
                                    <td><b>Coupon <span class="coupon_apply_txt">('.$order_details[0]->coupon_code.')</span></b></td> 
                                    <td>&nbsp;-&nbsp;'.$order_details[0]->coupon_value.'</td>';
        
                                $totalAmt = $totalAmt-$order_details[0]->coupon_value;
                                echo '<tr></tr><td colspan="5">&nbsp;</td> 
                                    <td><b>Final Price</b></td> 
                                    <td>'.$totalAmt.'</td><tr/>';
                                }
                              ?>    
                           </tbody> 
                         </table>
                       </div>
                  </div>
                </div>
              </div>
        </div>
        {{-- <div class="order_opertion">
            Update Order Status
            <select class="form-control">
                <option>Select Status</option>
            </select>
        
            Payment Status
            <select class="form-control">
                <option>Select Status</option>
            </select>
        
        </div> --}}
    </div>
</div>
<div class="order_opertion">
  <strong>Update Order Status</strong>
    <select class="form-control m-b-10" id="order_status" onchange="update_order_status({{ $order_details[0]->id }})">
      <?php
        foreach($orders_statu as $list){
            if( $list->orders_status  ==  $order_details[0]->order_status ){
              echo "<option value='".$list->id."' selected>".$list->orders_status."</option>"; 
            }else{
              echo "<option value='".$list->id."'>".$list->orders_status."</option>";   
            }      
        }
      ?>
   </select> 


  <strong> Update Payment Status</strong>
    <select class="form-control" id="payment_status" onchange="update_payment_status({{ $order_details[0]->id }})">
        <?php
          foreach ($payment_status as $list ){
              if($order_details[0]->payment_status==$list){
                echo"<option value='$list' selected>$list </option>";
              }else{
                echo"<option value='$list'>$list </option>";
              }       
          }
        ?>
    </select>
    
    <b>Track Details</b>
    <form method="post">
       <textarea name="track_details" class="form-control  m-b-10" required>{{ $order_details[0]->track_details }}</textarea>
       <button type="submit" class="btn btn-success">
         Update
     </button>
     @csrf
    </form>
</div>

@endsection
                    
               