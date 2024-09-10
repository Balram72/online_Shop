@extends('admin/layout')
@section('page_title','Manage Offers')
@section('offers_select','active')
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
                <h1>Special Offer</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/offers') }}">
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
                    <form action="{{ route('offers.manage_offer_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group has-success">
                                <label for="start_date" class="control-label mb-1">Start Date</label>
                                <input id="text" name="start_date"  value="{{ old('start_date',$start_date) }}" type="date" class="form-control cc-name valid" required>
                                @error('start_date')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                              
                            <div class="col-md-6 form-group has-success">
                                <label for="end_date" class="control-label mb-1">End Date</label>
                                <input id="date" name="end_date"  value="{{ old('end_date',$end_date) }}" type="date" class="form-control cc-name valid" required>
                                @error('end_date')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                               @enderror
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group has-success">
                                <label for="title" class="control-label mb-1">Offer Title </label>
                                <input id="text" name="title"  value="{{ old('title',$title) }}" type="text" class="form-control cc-name valid" required>
                                @error('title')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                        </div>   
                        <div class="row">
                            <div class="{{ $classs }} form-group has-success">
                                <label for="image" class="control-label mb-1">Offer image</label>
                                <input id="image" name="image"  type="file" class="form-control cc-name valid" {{ $image_required }}>
                              
                            </div>
                            @if($image!='')
                                <div class="col-md-4 form-group has-success">
                                    <label for="image" class="control-label mb-1">Old Offers image</label><br>
                                    <img src="{{ asset('storage/media/offers/'.$image) }}" alt="No Image" width="50px">
                                </div>  
                            @endif                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group has-success">
                                <label for="description" class="control-label mb-1">Offer description </label>
                                <textarea id="short_desc" name="description" class="form-control cc-name valid" >{{ old('description', $description) }}</textarea>
                              
                                @error('description')
                                <div class="alert alert-danger alert-block">
                                    {{ $message }}
                                </div>
                              @enderror   
                            </div>
                          
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
    <script>
                CKEDITOR.replace('short_desc');
    </script>
</div>

@endsection
                    
               