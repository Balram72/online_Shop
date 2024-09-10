@extends('front/layout')
@section('page_title','Chnage Password')
@section('container')

<section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
         <div class="aa-myaccount-area">         
           <div class="row">
            <div class="col-md-3"></div>
             <div class="col-md-6">
               <div class="aa-myaccount-register">                 
                <h4>Change Password</h4>
                <form action="" class="aa-login-form" id="frmUpdatePassword">
                   <label for="">Password<span>*</span></label>
                   <input type="password" name="password" placeholder="password" required>
                   <div id="password_error" class="field_error"></div>
                   <button type="submit" class="aa-browse-btn" id="btnUpdatePassword">Update Password</button> 
                   @csrf                   
                 </form>
               </div>
               <div id="thank_you_msg" class="field_error"></div>
             </div>
             <div class="col-md-3"></div>
           </div>          
         </div>
      </div>
    </div>
  </div>
</section>


@endsection