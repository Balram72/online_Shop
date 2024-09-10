@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
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
            <div class="col-md-4">
                <h1>Product</h1>
            </div>
            <div class="col-md-5">
                @if(Session::has('sku_error'))
                    <div class="alert alert-success">
                        {{ Session::get('sku_error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="col-md-3 text-right">
                <a href="{{ url('admin/product') }}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-left"></i>Back
                    </button>
                </a>
            </div>
        </div>

            
                {{-- @error('attr_image.*')
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @enderror --}}
           

            {{-- 
                @error('images.*')
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @enderror
             --}}
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <form action="{{ route('product.manage_product_process') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="col-md-12 m-t-15">
                <div class="card">
                    <div class="card-header">Manage Product</div>
                    <div class="card-body">
                            <div class="form-group has-success">
                                <label for="name" class="control-label mb-1">Product Name</label>
                                <input id="name" name="name" value="{{ old('name',$name) }}" type="text" class="form-control cc-name valid" required>
                                    @error('name')
                                        <div class="alert alert-danger alert-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="row">
                                    <div class="{{  $classs }} form-group has-success">
                                        <label for="image" class="control-label mb-1">Product image</label>
                                        <input id="image" name="image"  value="{{ old('image',$image) }}"type="file" class="form-control cc-name valid" {{ $image_required }}>
                                            @error('image')
                                                <div class="alert alert-danger alert-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    @if($image!='')
                                        <div class="col-md-4 form-group has-success">
                                            <label for="image" class="control-label mb-1">Old Product image</label><br>
                                            <img src="{{ asset('storage/media/'.$image) }}" alt="No Image" width="50px">
                                        </div>  
                                    @endif                              
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group has-success">
                                    <label for="category_id" class="control-label mb-1">Product category</label>
                                    <select name="category_id" id="category_id" class="form-control cc-name valid" required>
                                        <option value=""> Select Category </option>
                                        @foreach ( $category as $list )
                                            @if ($category_id ==  $list->id)
                                                <option selected value="{{ $list->id }}">
                                            @else
                                                <option  value="{{ $list->id }}">
                                            @endif
                                            {{ $list->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group has-success">
                                    <label for="slug" class="control-label mb-1">Product Slug</label>
                                    <input id="slug" name="slug" type="text" value="{{ old('slug',$slug) }}" class="form-control cc-name valid" required>
                                    @error('slug')
                                        <div class="alert alert-danger alert-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group has-success">
                                    <label for="brand" class="control-label mb-1">Product Brand</label>
                                    <select name="brand" id="brand" class="form-control cc-name valid" required>
                                        <option value=""> Select Brand</option>
                                        @foreach ( $brands as $list )
                                            @if ($brand ==  $list->id)
                                                <option selected value="{{ $list->id }}">
                                            @else
                                                <option  value="{{ $list->id }}">
                                            @endif
                                            {{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label for="model" class="control-label mb-1">Product model</label>
                                <textarea id="model" name="model" class="form-control cc-name valid" required>{{ old('model', $model) }}</textarea>
                                @error('model')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group has-success">
                                <label for="short_desc" class="control-label mb-1">Product short_desc</label>
                                <textarea id="short_desc" name="short_desc" class="form-control cc-name valid" required>{{ old('short_desc', $short_desc) }}</textarea>
                                @error('short_desc')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group has-success">
                                <label for="desc" class="control-label mb-1">Product desc</label>
                                <textarea id="desc" name="desc" class="form-control valid" required>{{ old('desc', $desc) }}</textarea>
                                @error('desc')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                       
                            <div class="form-group has-success">
                                <label for="technical_specification" class="control-label mb-1">Product technical_specification</label>
                                <textarea id="technical_specification" name="technical_specification" class="form-control valid" required>{{ old('technical_specification', $technical_specification) }}</textarea>
                                @error('technical_specification')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group has-success">
                                <label for="keywords" class="control-label mb-1">Product keywords</label>
                                <textarea id="keywords" name="keywords" class="form-control valid" required>{{ old('keywords', $keywords) }}</textarea>
                                @error('keywords')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group has-success">
                                <label for="uses" class="control-label mb-1">Product uses</label>
                                <textarea id="uses" name="uses" class="form-control valid" required>{{ old('uses', $uses) }}</textarea>
                                @error('uses')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group has-success">
                                <label for="warranty" class="control-label mb-1">Product warranty</label>
                                <textarea id="warranty" name="warranty" class="form-control valid" required>{{ old('warranty', $warranty) }}</textarea>
                                @error('warranty')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group has-success">
                                    <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                    <input id="lead_time" name="lead_time" type="text" value="{{ old('lead_time',$lead_time) }}" class="form-control cc-name valid">
                                </div>
                                <div class="col-md-6 form-group has-success">
                                    <label for="tax" class="control-label mb-1">Tax</label>
                                    <select name="tax_id" id="tax_id" class="form-control cc-name valid" required>
                                        <option value=""> Select Tax </option>
                                        @foreach ( $taxs as $list )
                                            @if ($tax_id ==  $list->id)
                                                <option selected value="{{ $list->id }}">
                                            @else
                                                <option  value="{{ $list->id }}">
                                            @endif
                                            {{ $list->tax_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                             
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group has-success">
                                    <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                    <select name="is_promo" id="is_promo" class="form-control cc-name valid" required>
                                        @if ($is_promo=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 form-group has-success">
                                    <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control cc-name valid" required>
                                        @if ($is_featured=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 form-group has-success">
                                    <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                    <select name="is_discounted" id="is_discounted" class="form-control cc-name valid" required>
                                        @if ($is_discounted=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 form-group has-success">
                                    <label for="is_tranding" class="control-label mb-1">Is Tranding</label>
                                    <select name="is_tranding" id="is_tranding" class="form-control cc-name valid" required>
                                        @if ($is_tranding=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                        @else
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <h2 class="mb-2 ml-3" >Product Images</h2>
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row" id="product_images_box">
                                            @php  
                                            $loop_count_num = 1;
                                            @endphp
                                         @foreach ($productImagesArr as $key=>$val)
                                            @php
                                                $loop_count_prev = $loop_count_num;
                                                $pIArr = (array)$val;
                                            @endphp
                                        <input id="piid" name="piid[]" type="hidden" value="{{$pIArr['id']}}">
                                            <div class="col-md-2 product_images_{{ $loop_count_num ++ }}" >
                                                <label for="images" class="control-label mb-1">Product images</label>
                                                <input id="images" name="images[]" type="file" class="form-control cc-name valid" aria-required="true" aria-invalid="flase">
                                            </div>
                                        @if($pIArr['images']!='')
                                            <div class="col-md-2">
                                                <label for="images" class="control-label mb-1">Old Image</label>
                                                <br>
                                                <a href="{{asset('storage/media/productsMultipalImage/'.$pIArr['images'])}}"  target="_blank" rel="noopener noreferrer">
                                                    <img src="{{asset('storage/media/productsMultipalImage/'.$pIArr['images'])}}" alt="No Image" width="100px"/>
                                                </a>
                                            </div>
                                        @endif
                                       
                                        @if ($loop_count_num==2)
                                            <div class="col-sm-2 pt-4">
                                                <button id="button" type="button" class="btn btn-lg btn-success btn-block" onclick="add_image_more()">
                                                    <i class="fa fa-plus"></i> Add
                                                </button>
                                            </div>
                                           @else
                                            <div class="col-md-2 pt-4">
                                                <a href="{{ url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{ $id }}">
                                                    <button id="button" type="button"  class="btn btn-lg btn-danger btn-block">
                                                     <i class="fa fa-minus"></i> Remove
                                                    </button>
                                                </a>
                                           </div>
                                        @endif
                                        @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            
            <h2 class="mb-2 ml-3" >Product Attributes</h2>
            <div class="col-md-12" id="product_attr_box">
                 @php  
                    $loop_count_num = 1;
                 @endphp
                @foreach ($productAttrArr as $key=>$val)
                     @php
                        $loop_count_prev = $loop_count_num;
                        $pAArr = (array)$val;
                     @endphp
                        <input id="paid" name="paid[]" type="hidden" value="{{$pAArr['id']}}">
                    <div class="card" id="product_attr_{{ $loop_count_num ++ }}">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                        <div class="col-md-2">
                                            <label for="sku" class="control-label mb-1">SKU</label>
                                            <input id="sku" name="sku[]" type="text" value="{{ old('sku',$pAArr['sku']) }}" class="form-control cc-name valid" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="mrp" class="control-label mb-1"> MRP </label>
                                            <input id="mrp" name="mrp[]" type="text" value="{{ old('mrp',$pAArr['mrp'] ) }}" class="form-control cc-name valid" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="price" class="control-label mb-1"> Price </label>
                                            <input id="price" name="price[]" type="text" value="{{ old('price',$pAArr['price'] ) }}" class="form-control cc-name valid" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="color_id" class="control-label mb-1">Product Color</label>
                                            <select name="color_id[]" id="color_id" class="form-control cc-name valid">
                                                <option  value="">Select color</option>
                                                @foreach ( $colors as $list )
                                                    @if ($pAArr['color_id'] ==  $list->id)
                                                        <option selected value="{{ $list->id }}"> {{ $list->color }}</option>
                                                     @else
                                                     <option  value="{{ $list->id }}"> 
                                                    @endif
                                                     {{ $list->color }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="size_id" class="control-label mb-1">Product Size</label>
                                            <select name="size_id[]" id="size_id" class="form-control cc-name    valid">
                                                <option value=""> Select Size </option>
                                                @foreach ( $sizes as $list )
                                                    @if ($pAArr['size_id'] ==  $list->id)
                                                        <option selected value="{{ $list->id }}"> {{ $list->size }}</option>
                                                    @else
                                                    <option  value="{{ $list->id }}">
                                                    @endif
                                                        {{ $list->size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="qty" class="control-label mb-1"> Qty </label>
                                            <input id="qty" name="qty[]" type="text" value="{{ old('qty',$pAArr['qty'])}}" class="form-control cc-name valid" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="attr_image" class="control-label mb-1">Product Attribute image</label>
                                            <input id="attr_image" name="attr_image[]" type="file" class="form-control cc-name valid" aria-required="true" aria-invalid="flase">
                                        </div>
                                        @if($pAArr['attr_image']!='')
                                            <div class="col-md-2">
                                                <label for="attr_image" class="control-label mb-1">Old Image</label>
                                                <br>
                                                <img src="{{asset('storage/media/productAttrImage/'.$pAArr['attr_image'])}}" alt="No Image" width="100px"/>
                                            </div>
                                        @endif
                                       
                                        @if ($loop_count_num==2)
                                            <div class="col-md-2 pt-4">
                                                <button id="button" type="button" class="btn btn-lg btn-success btn-block" onclick="add_more()">
                                                    <i class="fa fa-plus"></i> Add
                                                </button>
                                            </div>
                                           @else
                                            <div class="col-md-2 pt-4">
                                                <a href="{{ url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{ $id }}">
                                                    <button id="button" type="button"  class="btn btn-lg btn-danger btn-block">
                                                     <i class="fa fa-minus"></i> Remove
                                                    </button>
                                                </a>
                                           </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                  
            </div>
            <div class="col-md-4 float-right">
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    Submit
                </button>
            </div>
            <input type="hidden" name="id" value="{{ $id }}">
    </form>
</div>
    <script>
        var loop_count =1;
        function add_more(){
            loop_count++;
            var html = '<input id="paid" name="paid[]" type="hidden" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
            html+='<div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" value="{{ old('sku') }}" class="form-control cc-name valid" required></div>'; 

            html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1">Mrp</label><input id="mrp" name="mrp[]" type="text" value="{{ old('mrp') }}" class="form-control cc-name valid" required></div>';

            html+='<div class="col-md-2"><label for="price" class="control-label mb-1">price</label><input id="price" name="price[]" type="text" value="{{ old('price') }}" class="form-control cc-name valid" required></div>';

            var color_id_html =$('#color_id').html();
             color_id_html = color_id_html.replace("selected","");
            html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1">Color</label> <select name="color_id[]" id="color_id" class="form-control cc-name valid">'+color_id_html+'</select></div>';

            var size_id_html =$('#size_id').html();
            size_id_html = size_id_html.replace("selected","");
            html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1">Size</label> <select name="size_id[]" id="size_id" class="form-control cc-name valid">'+size_id_html+'</select></div>';

            html+='<div class="col-md-2"><label for="qty" class="control-label mb-1">Qty</label><input id="qty" name="qty[]" type="text" value="{{ old('qty') }}" class="form-control cc-name valid" required></div>';

            html+='<div class="col-md-6"><label for="attr_image" class="control-label mb-1">Product Attribute image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control cc-name valid" aria-required="true" aria-invalid="flase"></div>';

            html+=' <div class="col-md-2 pt-4"> <button id="button" type="button" class="btn btn-lg btn-danger btn-block" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i> Remove</button></div>';

            html+='</div></div></div></div>';
            $('#product_attr_box').append(html);
        }
        function remove_more(loop_count){
            $('#product_attr_'+loop_count).remove();
        }


        var loop_image_count = 1;
        function add_image_more(){
            loop_image_count++;
           var html='<input id="piid" name="piid[]" type="hidden" value=""><div class="col-md-2 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Product  image</label><input id="images" name="images[]" type="file" class="form-control cc-name valid" aria-required="true" aria-invalid="flase"></div>';
            html+=' <div class="col-md-2  pt-4 product_images_'+loop_image_count+'"> <button id="button" type="button" class="btn btn-lg btn-danger btn-block" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i> Remove</button></div>';

            $('#product_images_box').append(html);

        } 
        function remove_image_more(loop_image_count){
            $('.product_images_'+loop_image_count).remove();
        }  
        CKEDITOR.replace('short_desc');
        CKEDITOR.replace('desc');
        CKEDITOR.replace('technical_specification');        
    </script>
@endsection
                    
               