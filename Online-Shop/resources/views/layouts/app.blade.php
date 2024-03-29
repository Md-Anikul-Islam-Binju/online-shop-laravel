<!DOCTYPE html>
<html lang="en">
<head>
<title>E-Commerce(Shop)</title>
<meta name="csrf" value="{{ csrf_token() }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/responsive.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="sweetalert2.min.css">



</head>

<body>

<div class="super_container">   
<header class="header">


<!-- Top Bar -->
 @php
 $setting=DB::table('settings')
         ->where('settings.status',1) 
         ->get();
 @endphp

<div class="top_bar">
    <div class="container">
        <div class="row">
            @foreach($setting as $row)
            <div class="col d-flex flex-row">
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{URL::to('public/frontend/images/phone.png')}}" alt=""></div>+880{{$row->phone}}</div>
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{URL::to('public/frontend/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">{{$row->email}}</a></div>
                <div class="top_bar_content ml-auto">
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            @php
                             $language=session()->get('lang');
                            @endphp
                            <li>
                                @if(session()->get('lang') == 'bangla')
                                <a href="{{route('language.english')}}">English<i class="fas fa-chevron-down"></i></a>
                                @else
                                <a href="{{route('language.bangla')}}">Bangla<i class="fas fa-chevron-down"></i></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="top_bar_user">
                        @guest
                        <div class="user_icon"><img src="{{URL::to('public/frontend/images/user.svg')}}" alt=""></div>
                        <div><a href="{{route('login')}}">
                        @if(session()->get('lang') == 'bangla')
                        লগইন
                        @else
                        Register/Login
                        @endif
                        </a></div>
                        @else
                       <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="{{route('register')}}"> <div class="user_icon"><img src="{{URL::to('public/frontend/images/user.svg')}}" alt=""></div>Profile<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="{{route('user.wishlist')}}">Wishlist</a></li>
                                    <li><a href="{{route('user.checkout')}}">Checkout</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#exampleModal">Order Tracking</a></li>
                                    <li><a href="{{ route('user.logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        @endguest
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>      
</div>


<div class="header_main">
    <div class="container">
        <div class="row">

            @php
            $setting=DB::table('settings')
                    ->where('settings.status',1) 
                    ->get();
            @endphp

                    <!-- Logo -->
            @foreach($setting as $row)
            <div class="col-lg-2 col-sm-3 col-3 order-1">
                <div class="logo_container">
                    <div class="logo"><a href="{{url('/')}}">{{ $row->name }}</a></div>
                </div>
            </div>
            @endforeach



                    @php
             $category=DB::table('categories')->get();
             @endphp
            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                <div class="header_search">
                    <div class="header_search_content">
                        <div class="header_search_form_container">
                            <form action="{{route('product.search')}}" class="header_search_form clearfix" method="post">
                                @csrf
                                <input type="search" required="required" class="header_search_input" placeholder="Search for products..." name="search">
                                <div class="custom_dropdown">
                                    <div class="custom_dropdown_list">
                                        <span class="custom_dropdown_placeholder clc">All Categories</span>
                                        <i class="fas fa-chevron-down"></i>
                                        <ul class="custom_list clc">
                                            <li><a class="clc" href="#">All Categories</a></li>
                                             @foreach($category as $row)
                                            <li><a class="clc" href="#">{{$row->category_name}}</a></li>
                                             @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{URL::to('public/frontend/images/search.png')}}" alt=""></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


                                <!-- Wishlist -->
        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">

        @guest
        @else
        @php
         $wishlist=DB::table('wishlists')->where('user_id',Auth::id())->get(); 
        @endphp
        <div class="wishlist d-flex flex-row align-items-center justify-content-end">
        <div class="wishlist_icon"><img src="{{URL::to('public/frontend/images/heart.png')}}" alt=""></div>
            <div class="wishlist_content">
                <div class="wishlist_text"><a href="{{route('user.wishlist')}}">Wishlist</a></div>
                <div class="wishlist_count">{{count($wishlist)}}</div>
            </div>
        </div>
        @endguest

        @php  
        $information_setting=DB::table('infosettings')->first();
        $charge=$information_setting->shipping_charge;
        @endphp                    <!-- Cart -->
                            <div class="cart">
                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                    <div class="cart_icon">
                                        <img src="{{URL::to('public/frontend/images/cart.png')}}" alt="">
                                        <div class="cart_count"><span>{{Cart::count()}}</span></div>
                                    </div>
                                    <div class="cart_content">
                                        <div class="cart_text"><a href="{{route('show.cart')}}">Cart</a></div>
                                        @if(Session::has('coupon'))
                                        <div class="cart_price">{{ Session::get('coupon')['balance']+ $charge }} Tk</div>
                                        @else
                                        <div class="cart_price">{{Cart::Subtotal()}} Tk</div>
                                        @endif
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

        </div>
    </div>
</div>

 @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                 @php
                 $setting=DB::table('settings')
                         ->where('settings.status',1) 
                         ->get();
                 @endphp

                @foreach($setting as $row)
                <div class="col-lg-3 footer_col">
                    <div class="footer_column footer_contact">
                        <div class="logo_container">
                            <div class="logo"><a href="#">{{$row->name}}</a></div>
                        </div>
                        <div class="footer_title">Got Question? Call Us 24/7</div>
                        <div class="footer_phone">+880{{$row->phone}}</div>
                        <div class="footer_contact_text">
                            <p>{{$row->address}}</p>
                        </div>
                        <div class="footer_social">
                          <ul>
                            Go to Our Facebook Page:
                            <li><a href="{{$row->link}}"><i class="fab fa-facebook-f"></i></a></li>
                          </ul>
                        </div>
                    </div>
                </div>
                @endforeach

                
                 <div class="col-lg-2 offset-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Brands</div>
                        <ul class="footer_list">
                            <li><a href="#">Computers & Laptops</a></li>
                            <li><a href="#">Cameras & Photos</a></li>
                            <li><a href="#">Hardware</a></li>
                            <li><a href="#">Smartphones & Tablets</a></li>
                            <li><a href="#">TV & Audio</a></li>
                        </ul>
                    </div>
                 </div>

                 <div class="col-lg-2 offset-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Brands</div>
                        <ul class="footer_list">
                            <li><a href="#">Computers & Laptops</a></li>
                            <li><a href="#">Cameras & Photos</a></li>
                            <li><a href="#">Hardware</a></li>
                            <li><a href="#">Smartphones & Tablets</a></li>
                            <li><a href="#">TV & Audio</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- Copyright -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    
                    <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                        <div class="copyright_content">
                           Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </div>
                        <div class="logos ml-sm-auto">
                            <ul class="logos_list">
                                <li><a href="#"><img src="{{asset('public/frontend/images/logos_1.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('public/frontend/images/logos_2.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('public/frontend/images/logos_3.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('public/frontend/images/logos_4.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post" action="{{route('order.tracking')}}">
          @csrf
          <div class="form-row">
           <label>Status</label> 
           <input type="text" name="code" required="" class="form-control" placeholder="Your Order Status Code">   
          </div> <br>
        <button type="submit" class="btn btn-danger">Track Now</button>        
       </form> 
      </div>
    </div>
  </div>
</div>


<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('public/frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('public/frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{asset('public/frontend/plugins/easing/easing.js')}}"></script>
<script src="{{asset('public/frontend/js/custom.js')}}"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('public/frontend/js/product_custom.js')}}"></script>
<script src="{{asset('public/frontend/js/shop_custom.js')}}"></script>

<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

 <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script>


    <script>  
         $(document).on("click", "#return", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to Return?",
                  text: "Once return,You will return your Money!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Cancel!");
                  }
                });
            });
    </script>  

     
</body>

</html>