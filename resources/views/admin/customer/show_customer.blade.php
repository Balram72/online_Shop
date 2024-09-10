@extends('admin/layout')
@section('page_title','Show Customer Details')
@section('customer_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Customer Details</h1>
            </div>
        </div>
    </div>
    <div class="col-md-9 m-t-15">
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <th>{{$customer_list->name }}</th> 
                    </tr>
                    <tr>
                        <th >Email</th>
                        <th>{{$customer_list->email }}</th> 
                    </tr>
                    <tr>
                        <th >Mobile</th>
                        <th>{{$customer_list->mobile }}</th> 
                    </tr>
                    <tr>
                        <th >Address</th>
                        <th>{{$customer_list->address }}</th> 
                    </tr>
                    <tr>
                        <th>City</th>
                        <th>{{$customer_list->city }}</th> 
                    </tr>
                    <tr>
                        <th>State</th>
                        <th>{{$customer_list->state }}</th> 
                    </tr>
                     <tr>
                        <th>Zip</th>
                        <th>{{$customer_list->zip }}</th> 
                    </tr>
                    <tr>
                        <th>Company Name</th>
                        <th>{{$customer_list->company }}</th> 
                    </tr>
                    <tr>
                        <th>GST Number</th>
                        <th>{{$customer_list->gstin }}</th> 
                    </tr>
                    <tr>
                        <th>Added On</th>
                        <th>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i:s')}}</th> 
                    </tr>
                    <tr>
                        <th>Update On</th>
                        <th>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i:s')}}</th> 
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection
                    
               