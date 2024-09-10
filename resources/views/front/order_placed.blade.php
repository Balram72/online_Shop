@extends('front/layout')
@section('page_title','ORDER Placed')
@section('container')

<!-- product category -->
<section id="aa-product-category">
  <div class="container">
    <div class="row" style="text-align: center; color: #ff6666;font-weight: bold;">
        <br/><br/> <br/><br/>
        <h2>Your Order has been palced Successfully.....</h2>
        <h2>Order Id :- {{ session()->get('ORDER_ID') }} </h2>
        <br/><br/> <br/><br/>
    </div>
  </div>
</section>
@endsection