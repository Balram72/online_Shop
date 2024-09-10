@extends('admin/layout')
@section('page_title','Manage HomeBanner')
@section('home_banner_select','active')
@section('container')
@if($id>0)
   @php 
        $image_required ="";
       $classs = 'col-md-8';
  @endphp
@else
    @php
        $image_required = "required";
       $classs = 'col-md-12';
    @endphp       
@endif

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Home Banner</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/home_banner') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-left"></i>Back
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
            <div class="card">
                <div class="card-header">Manage Home Banner</div>
                <div class="card-body">
                    <form action="{{ route('home_banner.manage_home_banner_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group has-success">
                                <label for="btn_txt" class="control-label mb-1">btn_txt</label>
                                <input id="btn_txt" name="btn_txt"  value="{{ old('btn_txt',$btn_txt) }}" type="text" class="form-control cc-name valid" >
                            </div>
                            <div class="col-md-8 form-group has-success">
                                <label for="btn_link" class="control-label mb-1">btn_link</label>
                                <input id="btn_link" name="btn_link"  value="{{ old('btn_link',$btn_link) }}" type="text" class="form-control cc-name valid" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="{{ $classs }} form-group has-success">
                                <label for="image" class="control-label mb-1">Banner image</label>
                                <input id="image" name="image" type="file" class="form-control cc-name valid" {{  $image_required }}>
                            </div>
                            @if($image!='')
                                <div class="col-md-4 form-group has-success">
                                    <label for="image" class="control-label mb-1">Old Banner image</label><br>
                                    <img src="{{ asset('storage/media/banner/'.$image) }}" alt="No Image" width="50px">
                                </div>  
                            @endif                              
                        </div>
                        <div class="col-md-4 text-right">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}">
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection
                    
               