@extends('admin.Admin_layouts')
@section('product') active show-sub @endsection
@section('addproduct') active @endsection
@section('admin_content')
<span class="breadcrumb-item active">Edit Medicine</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Edit Medicine</h6>
            <form action="{{ Route('update.product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('message')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   @endif
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <input type="hidden" value="{{ $product->id }}" name="id">
                    <div class="form-group">
                        <label class="form-control-label">Medicine Name: <span class="tx-danger">*</span></label>
                        <input type="text" value="{{ $product->product_name }}" class="form-control  @error('product_name')is-invalid @enderror" name="product_name" >
                        @error('product_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Medicine Code: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control  @error('product_code')is-invalid @enderror" name="product_code"  value="{{ $product->product_code }}" >
                        @error('product_code')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Medicine Quantity: <span class="tx-danger">*</span></label>
                        <input type="number" class="form-control  @error('product_quantity')is-invalid @enderror" name="product_quantity"  value="{{ $product->product_quantity }}" placeholder="Enter Medicine Quantity..">
                        @error('product_quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control  @error('price')is-invalid @enderror" name="price"  value="{{ $product->price }}" placeholder="Enter Medicine Price..">
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div><!-- col-8 -->
                    <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                        <select class="form-control select2"  name="category_id" data-placeholder="Choose Category">
                        <option label="Choose Category"></option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"{{ $category->id ==$product->category_id ? "selected":"" }}>{{ $category->category_name }}</option>
                        @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" name="brand_id" data-placeholder="Choose Brand">
                            <option label="Choose Brand"></option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"{{ $brand->id ==$product->brand_id ? "selected":"" }}>{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-12">
                        <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Short Description: <span class="tx-danger">*</span></label>
                            <textarea id="summernote"class="@error('short_description')is-invalid @enderror" name="short_description">{{ $product->short_description }}</textarea>
                            @error('short_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-12">
                        <div class="form-group mg-b-10-force">
                        <label class="form-control-label  ">Long Description: <span class="tx-danger">*</span></label>
                            <textarea id="summernote2"  class="@error('long_description')is-invalid @enderror" name="long_description">{{ $product->long_description }}</textarea>
                            @error('long_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div><!-- col-4 -->
                </div>

              <button class="btn btn-info mg-r-5 mg-b-25" type="submit">Update Data</button>


            </form>

                <form action="{{ route('update.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->image_one }}" name="img_one">
                            <input type="hidden" value="{{ $product->image_two }}" name="img_two">
                            <input type="hidden" value="{{ $product->image_three }}" name="img_three">
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label">Main Image: <span class="tx-danger">*</span></label>
                                <img src="{{ asset($product->image_one) }}" width="120px;" height="120px;" alt="">
                                @error('image_one')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label">Preview imgae 1: <span class="tx-danger">*</span></label>
                                <img src="{{ asset($product->image_two) }}" width="120px;" height="120px;" alt="">
                                @error('image_one')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label">Preview imgae 2: <span class="tx-danger">*</span></label>
                                <img src="{{ asset($product->image_three) }}" width="120px;" height="120px;" alt="">
                                @error('image_one')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label">Main Image: <span class="tx-danger">*</span></label>
                                <input type="file" class="form-control  @error('image_one')is-invalid @enderror" name="image_one">
                                @error('image_one')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label">Preview imgae 1: <span class="tx-danger">*</span></label>
                                <input type="file" class="form-control  @error('image_two')is-invalid @enderror" name="image_two"  value="{{  $product->image_two }}">
                                @error('image_two')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label class="form-control-label">Preview imgae 2: <span class="tx-danger">*</span></label>
                                <input type="file" class="form-control  @error('image_three')is-invalid @enderror" name="image_three"  value="{{ $product->image_three }}">
                                @error('image_three')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                        </div><!-- row -->


                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Update Image</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
          </div><!-- card -->

    </div>
</div>
@endsection

