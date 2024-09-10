@extends('admin/layout')
@section('page_title','Customer')
@section('customer_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Customer Data</h1>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
        @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif

        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th class="text-center"> Name</th>
                        <th class="text-center"> Email</th>
                        <th class="text-center"> Mobile</th>
                        <th class="text-center"> City</th>
                        <th class="text-center">Status</th>                        
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $list->name }}</td>
                            <td class="text-center">{{ $list->email }}</td>
                            <td class="text-center">{{ $list->mobile }}</td>
                            <td class="text-center">{{ $list->city }}</td>
                            <td class="text-center">
                                @if ($list->status == 1)
                                    <a href="{{ url('admin/customer/status/0')}}/{{ $list->id  }}">
                                        <button type="button" class="btn btn-outline-info">Active</button>
                                    </a>
                                  @elseif($list->status == 0)
                                    <a href="{{ url('admin/customer/status/1')}}/{{ $list->id  }}">
                                        <button type="button" class="btn btn-outline-warning">DeActive</button>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('admin/customer/show/')}}/{{ $list->id  }}">
                                    <button type="button" class="btn btn-outline-success"><i class='fas fa-eye'></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection
                    
               