@extends('front/layout')
@section('page_title','Contact')
@section('container')

<section id="aa-contact">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-contact-area"> 
          <!-- Contact address -->
          <div class="aa-contact-address">
            <div class="row">
              <div class="col-md-8">
                <div class="aa-contact-address-left">
                  <form class="comments-form contact-form" action="{{ route('contact.send') }}" method="post">
                    @csrf
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">                        
                         <input type="text" placeholder="Your Name" name="name" class="form-control">
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">                        
                         <input type="email" placeholder="Email" name="email" class="form-control">
                       </div>
                     </div>
                   </div>                                    
                    
                   <div class="form-group">                        
                     <textarea class="form-control" rows="3" name="massage" placeholder="Message"></textarea>
                   </div>
                   <input type="submit" name="send" value="send">
                 </form>
                </div>
              </div>
              <div class="col-md-4">
                <div class="aa-contact-address-right">
                  <address>
                    <h4>Fashion Mart</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum modi dolor facilis! Nihil error, eius.</p>
                    <p><span class="fa fa-home"></span>bhubaneswar, Indai</p>
                    <p><span class="fa fa-phone"></span>+91 6352902955</p>
                    <p><span class="fa fa-envelope"></span>Email: support@fashionmart.com</p>
                  </address>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection