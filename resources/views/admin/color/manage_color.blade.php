@extends('admin/layout')
@section('page_title','Manage Color')
@section('color_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Color</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/color') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-left"></i>Back
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
            <div class="card">
                <div class="card-header">Manage Color</div>
                <div class="card-body">
                    <form action="{{ route('color.manage_color_process') }}" method="post">
                        @csrf
                        <div class="form-group has-success">
                            <label for="color" class="control-label mb-1">Color Name</label>
                            <input id="color" name="color" value="{{ old('color',$color) }}" type="text" class="form-control cc-name valid" required>
                                @error('color')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                    
               