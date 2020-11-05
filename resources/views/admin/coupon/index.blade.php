@extends('admin.Admin_layouts')
@section('coupon') active @endsection
@section('admin_content')
<span class="breadcrumb-item active">Coupon table</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-8 col-sm-12 col-lg-8">
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    @if(session('coupupdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('coupupdate')}}</strong>
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
                        <th>Coupon Name</th>
                        <th>Coupon discount</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($coupons as $coupon)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $coupon->coupon_name }}</td>
                        <td>{{ $coupon->coupon_discount }}%</td>
                        <td>
                            @if ($coupon->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/coupon/edit/' .$coupon->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                            <a href="{{ url('admin/coupon/delete/' .$coupon->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            @if ($coupon->status==1)
                            <a href="{{ url('admin/coupon/inactive/' .$coupon->id) }}" class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                            @else
                            <a href="{{ url('admin/coupon/active/' .$coupon->id) }}" class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
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
                <div class="card-header"> Add Coupon

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
                    <form action="{{ Route('store.coupon') }}" method="POST">
                        @csrf
                            <div class="form-group">
                            <input type="text" class="form-control  @error('coupon_name')is-invalid @enderror" name="coupon_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Coupon..">
                            @error('coupon_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control  @error('coupon_discount')is-invalid @enderror" name="coupon_discount" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Coupon discount..">
                                @error('coupon_discount')
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
