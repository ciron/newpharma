@extends('admin.Admin_layouts')
@section('product') active show-sub @endsection
@section('manageproduct') active @endsection
@section('admin_content')
<span class="breadcrumb-item active">Medicine List</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    {{-- @if(session('brandupdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('brandupdate')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   @endif
                   @if(session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('delete')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   @endif

                   @if(session('active'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>{{session('active')}}</strong>
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                  @endif
                  @if(session('inactive'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>{{session('inactive')}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                 @endif --}}
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Image</th>
                        <th>Medicine Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($products as $product)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <img src="{{ asset($product->image_one) }}" width="50px;" height="50px;" alt="">
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->brand->brand_name }}</td>
                        <td>
                            @if ($product->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/brand/edit/' .$product->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                            <a href="{{ url('admin/product/delete/' .$product->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            @if ($product->status==1)
                            <a href="{{ url('admin/product/inactive/' .$product->id) }}" class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                            @else
                            <a href="{{ url('admin/product/active/' .$product->id) }}" class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div><!-- card -->
        </div>

      </div>
    </div>
</div>
@endsection
