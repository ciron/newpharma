@extends('admin.Admin_layouts')
@section('category') active @endsection
@section('admin_content')
<span class="breadcrumb-item active">Category table</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-8 col-sm-12 col-lg-8">
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    @if(session('catupdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('catupdate')}}</strong>
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
                 @endif
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($categories as $category)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            @if ($category->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/category/edit/' .$category->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                            <a href="{{ url('admin/category/delete/' .$category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            @if ($category->status==1)
                            <a href="{{ url('admin/category/inactive/' .$category->id) }}" class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                            @else
                            <a href="{{ url('admin/category/active/' .$category->id) }}" class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div><!-- card -->
        </div>
        <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-header"> Add Category

                </div>

                <div class="card-body">
                    @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('message')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   @endif
                    <form action="{{ Route('store.category') }}" method="POST">
                        @csrf
                            <div class="form-group">
                            <input type="text" class="form-control  @error('category_name')is-invalid @enderror" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category..">
                            @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>
                    </form>

                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
