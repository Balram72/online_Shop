@extends('admin/layout')
@section('page_title','Order')
@section('order_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Order Details</h1>
            </div>
        </div>
    </div>

        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th class="text-center">Order Id</th>
                        <th class="text-center">Customer Details</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Order Status</th>                        
                        <th class="text-center">Paymet Status</th>
                        <th class="text-center">Paymet Type</th>
                        <th class="text-center">Order Date</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $list)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center"> <a href="{{url('/admin/order/order_detail') }}/{{ $list->id }}">
                              {{ $list->id }}</a> 
                            </td>
                            <td class="text-center">
                              {{ $list->name }}</br>
                              {{ $list->email }}</br>
                              {{ $list->mobile }}</br>
                              {{ $list->address }}, {{ $list->city }},{{ $list->state }},{{ $list->pincode }}
                            </td>
                            <td class="text-center">{{ $list->total_amt }}</td>
                                @php
                                $color = '';
                                if($list->order_status == 'Cancel') {
                                    $color = "color:red";
                                }
                            @endphp
                            <td class="text-center" style="{{ $color }}">{{ $list->order_status }}</td>
                            <td class="text-center">{{ $list->payment_status }}</td>
                            <td class="text-center">{{ $list->payment_type }}</td>

                            <td class="text-center">{{ $list->added_on }}</td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection
                    
               