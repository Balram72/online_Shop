@extends('admin/layout')
@section('page_title','Manage Tax')
@section('tax_select', 'active')
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h1>Tax</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('admin/tax') }}">
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
                    <form action="{{ route('tax.manage_tax_process') }}" method="post">
                        @csrf
                        <div class="form-group has-success">
                            <label for="tax_value" class="control-label mb-1">Tax Value</label>
                            <input id="tax_value" name="tax_value" value="{{ $tax_value }}" type="text" class="form-control cc-name valid" required>
                                @error('tax_value')
                                    <div class="alert alert-danger alert-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="tax_desc" class="control-label mb-1">Tax Desc</label>
                            <input id="tax_desc" name="tax_desc" value="{{ $tax_desc }}" type="text" class="form-control cc-name valid" required>
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
                    
               