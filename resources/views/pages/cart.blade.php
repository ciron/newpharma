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
                        <a href="./index.html">Home</a>
                        <a href="./index.html">Cart</a>
                        <span>Cart Details</span>
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
            @if(session('cartdel'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('cartdel')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
           @endif
           @if(session('cartup'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>{{session('cartup')}}</strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
          @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)


                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset($cart->product->image_one) }}" style="max-width: 60px;" alt="">
                                        <h5>{{ $cart->product->product_name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ৳{{ $cart->price }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <form action="{{ Route('Cart.edit',$cart->id) }}" method="ANY">
                                                @csrf
                                                <div class="pro-qty">
                                                    <input type="number" name="qty" value="{{ $cart->qty }}" min="1">
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ৳{{ $cart->price*$cart->qty }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{ route('Cart.show',$cart->id) }}">
                                            <span class="icon_close"></span>

                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ url('/') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                    </div>
                </div>
                <div class="col-lg-6">
                    {{-- @if (Session::has('coupon')) --}}

                    {{-- @else --}}
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="{{ route('aplycupon') }}" method="POST">
                                @method('post')
                                @csrf
                                <input type="text" name="coupon_name" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                    {{-- @endif --}}
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>

                            @if (Session::has('coupon'))
                            <li>Subtotal <span>{{ $subtotal }}৳</span></li>
                            <li>Discount <span>{{ Session()->get('coupon')['coupon_discount'] }}%({{ $discount=$subtotal*Session()->get('coupon')['coupon_discount'] /100 }}৳)</span></li>
                            <li>Total <span>{{ $subtotal - $discount }} ৳</span></li>
                            @else
                            <li>Subtotal <span>৳{{ $subtotal }}</span></li>
                            @endif

                        </ul>
                        <a href="{{ route('checkout.index') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->



@endsection
