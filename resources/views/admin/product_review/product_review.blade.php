@extends('admin/layout')
@section('page_title','Product Review')
@section('product_review_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Product Review</h1>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
    
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th class="text-center">User Name</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Rating</th>  
                        <th class="text-center">Review</th> 
                        <th class="text-center">Added On</th>                        
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $list->name }}</td>
                            <td class="text-center">{{ $list->pname }}</td>
                            <td class="text-center">{{ $list->rating }}</td>
                            <td class="text-center">{{ $list->review }}</td>
                            <td class="text-center">{{ $list->added_on }}</td>
                            <td class="text-center">
                                @if ($list->status == 1)
                                    <a href="{{ url('admin/product_review/update_product_review_status/0')}}/{{ $list->id  }}">
                                        <button type="button" class="btn btn-outline-info">Active</button>
                                    </a>
                                  @elseif($list->status == 0)
                                    <a href="{{ url('admin/product_review/update_product_review_status/1')}}/{{ $list->id  }}">
                                        <button type="button" class="btn btn-outline-warning">DeActive</button>
                                    </a>
                                @endif
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
                    
               