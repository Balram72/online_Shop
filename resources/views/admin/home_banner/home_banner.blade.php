@extends('admin/layout')
@section('page_title','Home Banner')
@section('home_banner_select','active')

@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Banners</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/home_banner/manage_home_banner') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>add Banners
                    </button>
                </a>
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
                        <th class="text-center">Btn Text</th>
                        <th class="text-center">Image</th>                
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $list->btn_txt }}</td>
                            <td class="text-center">
                                @if ($list->image!='')
                                   <img src="{{ asset('storage/media/banner/'.$list->image) }}" alt="No Image"  width="100px"></td>
                                @else
                                    <h5>No Image</h5>
                                @endif
                                
                            <td class="text-center">
                                @if ($list->status == 1)
                                    <a href="{{ url('admin/home_banner/status/0')}}/{{ $list->id  }}">
                                        <button type="button" class="btn btn-outline-info">Active</button>
                                    </a>
                                  @elseif($list->status == 0)
                                    <a href="{{ url('admin/home_banner/status/1')}}/{{ $list->id  }}">
                                        <button type="button" class="btn btn-outline-warning">DeActive</button>
                                    </a>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ url('admin/home_banner/manage_home_banner/')}}/{{ $list->id  }}">
                                    <button type="button" class="btn btn-outline-success"><i class="fas fa-pencil-alt"></i></button>
                                </a>

                                <a href="{{ url('admin/home_banner/delete/')}}/{{ $list->id  }}">
                                    <button type="button" class="btn btn-outline-danger"><i class='fas fa-trash-alt'></i></button>
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
                    
               