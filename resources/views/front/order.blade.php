@extends('front/layout')
@section('page_title','Order')
@section('container')
<section id="cart-view">
  <div class="container">
    <div class="row">
          @if (session('status'))
          <script type="text/javascript">
              $(document).ready(function() {
                  toastr.success("{{ session('status') }}");
              });
          </script>
      @endif
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form action="">
              <div class="table-responsive">
                 <table class="table">
                   <thead>
                     <tr>
                       <th>Order ID</th>
                       <th>Order Status</th>
                       <th>Payment Status</th>
                       <th>Payment Type</th>
                       <th>Total Amount</th>
                       <th>Payment Id</th>
                       <th>Place At</th>
                       <th>Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    @foreach ($orders as $list)
                      @if($list->order_status !== 'Cancel')
                      <tr>
                        <td class="order_id_btn"><a href="{{ url('/order_detail')}}/{{ $list->id }}">{{ $list->id }}</a></td>
                        <td>{{ $list->order_status }}</td>
                        <td>{{ $list->payment_status }}</td>
                        <td>{{ $list->payment_type }}</td>
                        <td>{{ $list->total_amt }}</td>
                        <td>{{ $list->payment_id }}</td>
                        <td>{{ $list->added_on }}</td>
                        @if($list->order_status !== 'Delivered')
                          <td class="order_id_btn">
                            <a href="#" onclick="confirmCancel(event, {{ $list->id }})">Cancel Order</a>
                          </td>  
                        @endif                  
                      </tr>
                      @endif
                    @endforeach
                 </table>
               </div>
             
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script type="text/javascript">
    function confirmCancel(event, orderId) {
        event.preventDefault(); // Prevent the default link action
        swal({
            title: "Are you sure?",
            text: "Once canceled, you will not be able to recover this order!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = '/cancel_order/' + orderId;
            }
        });
    }
</script>
</section>

@endsection