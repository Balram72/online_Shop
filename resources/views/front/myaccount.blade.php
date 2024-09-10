@extends('front/layout')
@section('page_title','My Account')
@section('container')
<section id="checkout">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="checkout-area">
         <form id="frmPlaceOrder">
           <div class="row">
             <div class="col-md-8">
               <div class="checkout-left">
                 <div class="panel-group" id="accordion">    
                   <!-- Billing Details -->
                   <div class="panel panel-default aa-checkout-billaddress">
                     <div class="panel-heading">
                       <h4 class="panel-title">
                         <a  href="javascript:void(0)">
                           User Register Address
                         </a>
                       </h4>
                     </div>
                     <div class="panel-collapse ">
                       <div class="panel-body">
                         <div class="row">
                          <div class="col-md-4">
                            <div class="aa-checkout-single-bill">
                              <input type="text" placeholder="Name*"  name="name" value="{{  $customerdata->name ?? '' }}" >
                            </div>                             
                          </div>
                           <div class="col-md-4">
                             <div class="aa-checkout-single-bill">
                               <input type="email" placeholder="Email Address*" name="email" value="{{ $customerdata->email ?? '' }}" >
                             </div>                             
                           </div>
                           <div class="col-md-4">
                             <div class="aa-checkout-single-bill">
                               <input type="text" placeholder="Phone*" name="mobile" value="{{ $customerdata->mobile ?? '' }}">
                             </div>
                           </div>
                         </div> 
                         <div class="row">
                           <div class="col-md-12">
                             <div class="aa-checkout-single-bill">
                               <textarea cols="8" rows="3" name="address" placeholder="Enter Address* " required>{{ $customerdata->address ?? ''  }}</textarea>
                             </div>                             
                           </div>                            
                         </div>      
                         <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="City / Town*" name="city" value="{{  $customerdata->city ?? '' }} " required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="State*" name="state" value="{{ $customerdata->state ?? '' }}" required>
                              </div>                             
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*" name="pincode" value="{{ $customerdata->zip ?? '' }}" required>
                              </div>
                            </div>
                         </div>                                    
                       </div>
                     </div>
                   </div>
                   <!-- Shipping Address -->
                 </div>
               </div>
             </div>
           </div>
           @csrf
         </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection