@extends('admin.Admin_layouts')
@section('admin_content')
<span class="breadcrumb-item active">Category Edit</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Edit Category
                </div>
                <div class="card-body">

                    <form action="{{ Route('update.category') }}" method="POST">
                        @csrf
                            <input type="hidden" value="{{ $category->id }}" name="id">
                            <div class="form-group">
                            <input type="text" class="form-control  @error('category_name')is-invalid @enderror" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $category->category_name }}">
                            @error('category_name')
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
