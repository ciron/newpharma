<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharmacy|Website</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @php
        $total = App\cart::all()->where('user_ip',request()->ip())->sum(function ($t){
            return $t->qty*$t->price;
        })
    @endphp
    @php
        $quantity = App\cart::all()->where('user_ip',request()->ip())->sum('qty')
    @endphp
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('frontend') }}/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="{{ route('Cart.index') }}"><i class="fa fa-shopping-bag"></i> <span>{{ $quantity }}</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>৳{{ $total }}</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                @guest
                    <div class="header__top__right__auth">
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                </div>
                    @if (Route::has('register'))
                <div class="header__top__right__auth">
                    <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                </div>
                    @endif
                @else
                <img src="" alt="">
                <div>  {{ Auth::user()->name }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                @endguest
            </div>

        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> chiron.cse1998@gmail.com</li>
                <li>Free Shipping for all Order of ৳99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> chiron.cse1998@gmail.com</li>
                                <li>Free Shipping for all Order of 99 Taka</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">

                                 @guest
                                     <div class="header__top__right__auth">
                                        <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                                    </div>
                                     @if (Route::has('register'))
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                                    </div>
                                     @endif
                                 @else
                                <img src="" alt="">
                                <div>  {{ Auth::user()->name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                @endguest
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @if(session('cartadd'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('cartadd')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   @endif
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('frontend') }}/img/logo2.png" alt="" width="100px;" height="50px;" ></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="./shop-grid.html">Medicine</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ route('Cart.index') }}">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">

                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="{{ route('Cart.index') }}"><i class="fa fa-shopping-bag"></i> <span>{{ $quantity }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>৳{{ $total }}</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


@yield('Frontend_master')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('frontend') }}/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: mirpur,11.5</li>
                            <li>Phone:01868190622</li>
                            <li>Email: chiron.cse1998@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Chironjit Roy <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://www.bubt.edu.bd/" target="_blank">(BUBT)</a>
 </p></div>
                        <div class="footer__copyright__payment"><img src="{{ asset('frontend') }}/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery-ui.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('frontend') }}/js/mixitup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
</body>

</html>
