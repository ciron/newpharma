@extends('admin.Admin_layouts')
@section('admin_content')
<span class="breadcrumb-item active">Coupon Edit</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Edit Coupon
                </div>
                <div class="card-body">

                    <form action="{{ Route('update.coupon') }}" method="POST">
                        @csrf
                            <input type="hidden" value="{{ $coupon->id }}" name="id">
                            <div class="form-group">
                            <input type="text" class="form-control  @error('coupon_name')is-invalid @enderror" name="coupon_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $coupon->coupon_name }}">
                            @error('coupon_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control  @error('coupon_discount')is-invalid @enderror" name="coupon_discount" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $coupon->coupon_discount }}">
                                @error('coupon_discount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
