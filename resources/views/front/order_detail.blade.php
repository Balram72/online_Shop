@extends('front/layout')
@section('page_title','Order Details')
@section('container')
<section id="cart-view">
  <div class="container">
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
              <br />
              <br />
              <b>Track Details</b>: <span class="coupon_apply_txt" style="font-size:19px"> {{ $order_details[0]->track_details  }} </span><br/>
             
        </div>
      
      </div>
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form action="">
              <div class="table-responsive">
                 <table class="table">
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
                        <td><img src="{{asset('storage/media/productAttrImage/'.$list->attr_image)}}" alt="No Image"></td>
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection