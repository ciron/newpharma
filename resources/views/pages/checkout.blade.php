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
                        <span>Checkout Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
   <!-- Checkout Section Begin -->
   <section class="checkout spad">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div> --}}
        </div>
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="{{ url('checkout/create') }}" method="get">
                @csrf
                <div class="row">

                        <div class="col-lg-8 col-md-6">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input id="cus_name" type="text" class="form-control @error('cus_name') is-invalid @enderror" name="cus_name" value="{{ old('cus_name') }}"  autocomplete="name" autofocus>
                                        @error('cus_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input id="cus_address" type="text" class=" @error('cus_address') is-invalid @enderror" name="cus_address" value="{{ old('cus_address') }}"  autocomplete="cus_address" autofocus>
                                        @error('cus_address')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input id="cus_city" type="text" class=" @error('cus_city') is-invalid @enderror" name="cus_city" value="{{ old('cus_city') }}"  autocomplete="cus_city" autofocus>
                                @error('cus_city')
                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input id="cus_phone" type="text" class=" @error('cus_phone') is-invalid @enderror" name="cus_phone" value="{{ old('cus_phone') }}"  autocomplete="cus_phone" autofocus>
                                        @error('cus_phone')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input id="cus_email" type="email" class=" @error('cus_email') is-invalid @enderror" name="cus_email" value="{{ old('cus_email') }}"  autocomplete="cus_email" autofocus>
                                        @error('cus_email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </form>
                        </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>

                            <div class="checkout__order__products">Products <span>Total</span></div>
                            @foreach ($carts as $cart)
                            <ul>
                                <li>{{ $cart->product->product_name }}({{ $cart->qty }}) <span> ৳{{ $cart->price*$cart->qty }}</span></li>
                            </ul>
                            @endforeach
                            @if (Session::has('coupon'))

                            <div class="checkout__order__subtotal">Subtotal <span>৳{{ $subtotal }}</span></div>
                            <div class="checkout__order__total">Discount <span>{{ Session()->get('coupon')['coupon_discount'] }}%({{ $discount=$subtotal*Session()->get('coupon')['coupon_discount'] /100 }}৳)</span></div>
                            <div class="checkout__order__total">Total <span>{{ $subtotal - $discount }} ৳</span></div>
                            @else
                                <div class="checkout__order__total">total <span>৳{{ $subtotal }}</span></div>
                            @endif
                            {{-- <div class="checkout__input__checkbox">
                                <label for="acc-or">
                                    Create an account?
                                    <input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>
                                </label>
                            </div> --}}
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Bkash
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

@endsection
