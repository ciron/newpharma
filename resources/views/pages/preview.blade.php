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
{{-- @php
    $check=App\Review::where('product_id',$product_id)->get();
@endphp --}}
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend') }}/img/pbnr.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Medicine Details</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <a href="./index.html">Medicine</a>
                        <span>Preview Medicine</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
       @endif
       @if(session('cartadd'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('cartadd')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
       @endif
       @if(session('wishadd'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>{{session('wishadd')}}</strong>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
      @endif
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ asset($product->image_one) }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{ asset($product->image_one) }}"
                            src="{{ asset($product->image_one) }}" alt="">
                        <img data-imgbigurl="{{ asset($product->image_two) }}"
                            src="{{ asset($product->image_two) }}" alt="">
                        <img data-imgbigurl="{{ asset($product->image_three) }}"
                            src="{{ asset($product->image_three) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->product_name }}</h3>

                    <div class="product__details__rating">
                        @if ( $product->rating==5)
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        @elseif($product->rating==4)
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        @elseif($product->rating==3)
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        @elseif($product->rating==2)
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        @else
                        <i class="fa fa-star"></i>
                        @endif

                    </div>
                    <div class="product__details__price">৳{{ $product->price }}</div>
                    <p>{!! $product->short_description !!}</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <form action="{{ Route('product.cart',$product->id) }}" method="post">
                                @csrf
                                <div class="pro-qty">
                                    <input type="number" name="qty" value="1" min="1">
                                    <input type="hidden" name="price" value="{{ $product->price}}">
                                    <input type="hidden" name="product_id" value="{{ $product->product_id}}">
                                </div>
                                <button type="submit" class="primary-btn">ADD TO CARD</button>
                            </form>
                        </div>
                    </div>
                    {{-- <a href="#" class="primary-btn"></a> --}}
                  @if (App\Wishlist::where('product_id',$product->id)->where('user_id',Auth::id())->where('quantity',1)->first())
                  <p class="heart-icon bg-success"style="color: black;" ><span class="icon_heart_alt"></span></p>
                  @else
                  <a href="{{ route('wishlist.create',$product->id) }}" class="heart-icon" style="color: red;"><span class="icon_heart_alt"></span></a>
                  @endif
                    {{-- <a href="#" class="heart-icon" style="color: red;"><span class="icon_heart_alt"></span></a> --}}

                    <ul>
                        <li><b>Availability</b> <span>
                            @if ($product->product_quantity>=4)
                            In Stock
                            @elseif($product->product_quantity>=1)
                            Stock is low
                            @elseif($product->product_quantity==0)
                            Out Of Stock
                            @endif
                           ({{$product->product_quantity }})
                        </span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        {{-- <li><b>Weight</b> <span>0.5 kg</span></li> --}}
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>{{ $product->product_name }} Information</h6>
                                <p>{!! $product->long_description !!}</p>
                            </div>
                        </div>
                        {{-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Medicine Information</h6>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition,</p>
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the wo</p>
                            </div>
                        </div> --}}
                        <div class="tab-pane" id="tabs-3" role="tabpanel">



                            <div class="product__details__tab__desc">
                                <h6>{{ $product->product_name }} Information</h6>
                                <p>{!! $product->cus_review  !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2> Product Review </h2>
                </div>
                <form action="{{ route('review.add',$product->id) }}" method="any">
                    <div class="form-group">
                        <input type="hidden" name="product_id" value="{{ $product->id  }}">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <label class="form-control-label">Customer Review: <span class="tx-danger"></span></label><br>
                        <textarea style="width: 100%" id="summernote"class="@error('cus_review')is-invalid @enderror" name="cus_review"></textarea>
                        @error('cus_review')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Select Rating</label><br>
                        <select  name="rating" data-placeholder="Choose Brand">
                            <option>Choose rating point</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        @error('cus_review')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                   <br>
                    <button type="submit" style="margin-top: 10px;" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
</section>
<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($related_pro as $product)


            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->image_one) }}">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{route('product.details',$product->id)}}">{{ $product->product_name }}</a></h6>
                        <h5>৳{{ $product->price }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Product Section End -->

@endsection
