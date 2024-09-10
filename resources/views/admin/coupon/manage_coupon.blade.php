@extends('admin/layout')
@section('page_title','Manage Coupon')
@section('coupon_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Coupon</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/coupon') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-left"></i>Back
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-t-15">
            <div class="card">
                <div class="card-header">Manage Coupon</div>
                <div class="card-body">
                    <form action="{{ route('coupon.manage_coupon_process') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group has-success">
                                <label for="coupon_title" class="control-label mb-1">Coupon Name</label>
                                <input id="coupon_title" name="title"  value="{{ old('title',$title) }}" type="text" class="form-control cc-name valid" required>
                                    @error('title')
                                        <div class="alert alert-danger alert-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="col-md-6 form-group has-success">
                                <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                                <input id="coupon_code" name="code" type="text" value="{{old('code',$code) }}" class="form-control cc-name valid" required>
                                @error('code')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group has-success">
                                <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                                <input id="coupon_value" name="value" type="text" value="{{ old('value',$value) }}"  class="form-control cc-name valid" >
                                @error('value')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group has-success">
                                <label for="type" class="control-label mb-1">Type</label>
                                <select name="type" id="type" class="form-control cc-name valid" required>
                                    @if ($type=='Value')
                                    <option value="Value" selected>Value</option>
                                    <option value="Per">Per</option>
                                    @elseif ($type=='Per')
                                    <option value="Value">Value</option>
                                    <option value="Per" selected>Per</option>
                                    @else
                                    <option value="Value">Value</option>
                                    <option value="Per">Per</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group has-success">
                                <label for="min_order_amt" class="control-label mb-1">Min Order Amt</label>
                                <input id="min_order_amt" name="min_order_amt" type="text" value="{{$min_order_amt}}" class="form-control cc-name valid">
                            </div>
                            <div class="col-md-6 form-group has-success">
                                <label for="is_one_time" class="control-label mb-1">Is One_Time</label>
                                <select name="is_one_time" id="is_one_time" class="form-control cc-name valid" required>
                                    @if ($is_one_time=='1')
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                    @endif
                                </select>
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
                    
               