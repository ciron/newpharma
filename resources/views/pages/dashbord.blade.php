@extends('layouts.frontend_master')
@section('Frontend_master')

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">

        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Category</span>
                    </div>
                    @php
                        $categories = App\Category::where('status',1)->latest()->get();
                    @endphp
                    <ul>
                        @foreach ($categories as $category)
                        <li><a href="#">{{ $category->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend') }}/img/pbnr.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Medicine Details</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url('/') }}">Home</a>

                        <span>Orders Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

 <!-- Shoping Cart Section Begin -->
 <section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th class="shoping__product">Medicine Name</th>
                                <th>Customer Name</th>
                                <th>phone</th>
                                <th>Price</th>
                                <th>Address</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
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
                                        @if ($row->status==0)
                                        <h5> Pending</h5>
                                        @else
                                        <h5> Confirm</h5>
                                        @endif

                                    </h5>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Shoping Cart Section End -->


@endsection
