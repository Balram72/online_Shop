@extends('admin/layout')
@section('page_title','Manage Brand')
@section('brand_select', 'active')
@section('container')

@if($id>0)
   @php
       $classs = 'col-md-10';
   @endphp    
@else
   @php
      $classs = 'col-md-12';
   @endphp 
@endif
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Brand</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/brand') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-left"></i>Back
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
            <div class="card">
                <div class="card-header">Manage Brand</div>
                <div class="card-body">
                    <form action="{{ route('brand.manage_brand_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group has-success">
                            <label for="name" class="control-label mb-1">Brand Name</label>
                            <input id="name" name="name" value="{{ old('name',$name) }}" type="text" class="form-control cc-name valid" required>
                                @error('name')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                    <div class="{{ $classs }} form-group has-success">
                                        <label for="image" class="control-label mb-1">Brand Image</label>
                                        <input id="image" name="image" type="file" class="form-control cc-name valid" >
                                            @error('image')
                                                <div class="alert alert-danger alert-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    @if ($image!='')
                                     <div  class="col-md-2 form-group has-success">
                                        <label for="image" class="control-label mb-1">Old Image</label><br>
                                        <img src="{{ asset('storage/media/BrandsImage/'.$image )}}" alt="No Image" width="100px"/>
                                     </div>
                                    @endif
                            </div>
                            <div class="col-md-3 form-group has-success">
                                <label for="is_home" class="control-label mb-1">Show In Home Page</label>
                                <input id="is_home" name="is_home" type="checkbox" {{ $is_home_selected }}>
                            </div>
                        <div class="col-md-4">
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
                    
               