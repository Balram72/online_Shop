@extends('admin/layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')
@if($id>0)
   @php 
       $classs = 'col-md-8';
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
                <h1>Category</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/category') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-left"></i>Back
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
            <div class="card">
                <div class="card-header">Manage Category</div>
                <div class="card-body">
                    <form action="{{ route('category.manage_category_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class=" col-md-4 form-group has-success">
                                <label for="category_name" class="control-label mb-1">Category Name</label>
                                <input id="category_name" name="category_name"  value="{{ old('category_name',$category_name) }}" type="text" class="form-control cc-name valid" required>
                            </div>
                            <div class=" col-md-4 form-group has-success">
                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" value="{{ old('category_slug',$category_slug) }}" class="form-control cc-name valid" >
                                @error('category_slug')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group has-success">
                                <label for="parent_category_id" class="control-label mb-1">Parent category</label>
                                <select name="parent_category_id" id="parent_category_id" class="form-control cc-name valid" >
                                    <option value="0"> Select Category </option>
                                    @foreach ( $category as $list )
                                        @if ($parent_category_id ==  $list->id)
                                            <option selected value="{{ $list->id }}">
                                        @else
                                            <option  value="{{ $list->id }}">
                                        @endif
                                        {{ $list->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="{{  $classs }} form-group has-success">
                                <label for="category_image" class="control-label mb-1">Product image</label>
                                <input id="category_image" name="category_image"  value="{{ $category_image }}"type="file" class="form-control cc-name valid">
                            </div>
                            @if($category_image!='')
                                <div class="col-md-4 form-group has-success">
                                    <label for="image" class="control-label mb-1">Old Product image</label><br>
                                    <img src="{{ asset('storage/media/category_image/'.$category_image) }}" alt="No Image" width="50px">
                                </div>  
                            @endif                              
                        </div>
                        <div class="col-md-3 form-group has-success">
                            <label for="is_home" class="control-label mb-1">Show In Home Page</label>
                            <input id="is_home" name="is_home" type="checkbox" {{ $is_home_selected }}>
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
                    
               