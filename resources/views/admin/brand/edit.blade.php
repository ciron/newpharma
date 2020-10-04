@extends('admin.Admin_layouts')
@section('admin_content')
<span class="breadcrumb-item active">Brand Edit</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Edit Brand
                </div>
                <div class="card-body">

                    <form action="{{ Route('update.brand') }}" method="POST">
                        @csrf
                            <input type="hidden" value="{{ $brand->id }}" name="id">
                            <div class="form-group">
                            <input type="text" class="form-control  @error('brand_name')is-invalid @enderror" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brand->brand_name }}">
                            @error('brand_name')
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
