@extends('admin.Admin_layouts')
@section('order') active show-sub @endsection
@section('pendingorder') active @endsection
@section('admin_content')
<span class="breadcrumb-item active">Order List</span>
</nav>
<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card pd-20 pd-sm-40">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    @if(session('medupdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('medupdate')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   @endif
                   @if(session('sucsess'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('sucsess')}}</strong>
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
                        {{-- <th>Image</th> --}}
                        <th>Medicine Name</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>price</th>
                        <th>Address</th>
                        <th>Quantity</th>
                        <th>Totall</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                       @foreach ($orderdeatils as $row)
                       <tr>
                           <td class="shoping__cart__price">

                               <h5>{{ $i++ }}</h5>
                           </td>
                           <td class="shoping__cart__price">

                               <h5>{{ $row->product_name }}</h5>
                           </td>
                           <td class="shoping__cart__price">
                               <h5> {{$row->cus_name}}</h5>
                           </td>
                           <td class="shoping__cart__price">
                              <h5> {{ $row->cus_phone }}</h5>
                           </td>
                           <td class="shoping__cart__price">
                            <h5> {{ $row->price }}</h5>
                           </td>
                           <td class="shoping__cart__price">
                              <h5>  {{ $row->cus_address }}</h5>
                           </td>
                           <td class="shoping__cart__price">
                               <h5> {{ $row->qty }}</h5>
                           </td>

                           <td class="shoping__cart__total">
                               <h5> {{ $row->totallprice }}</h5>
                           </td>
                           <td class="shoping__cart__total">
                               <h5>
                                <a href="{{ route('shift.order',$row->id) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="" class="btn btn-success"><i class="fa fa-eye"></i></a>

                               </h5>
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
