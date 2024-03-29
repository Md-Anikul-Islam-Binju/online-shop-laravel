@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/shop_responsive.css')}}">

<div class="super_container">

	
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Category wise Product Shows</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
								<li><a href="#">Computers & Laptops</a></li>
								<li><a href="#">Cameras & Photos</a></li>
								<li><a href="#">Hardware</a></li>
							
							</ul>
						</div>


					  <div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
								@foreach($brands as $row)
								   @php 
								    $brand=DB::table('brands')->where('id',$row->brand_id)->first();
								   @endphp
								<li class="brand"><a href="#">{{ $brand->brand_name}}</a></li>
								@endforeach
							</ul>
						</div>
			
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>Searce</span> products found</div>
							<div class="shop_sorting">
							
							</div>
						</div>

						<div class="product_grid row">
							<div class="product_grid_border"></div>

							@foreach($products as $pro)
							<!-- Product Item -->
							<div class="product_item is_new ">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($pro->image_one) }}" style="height: 100px; width: 100px;"></div>
								<div class="product_content">

									@if($pro->discount_price == NULL)
									    <br><span class="text-danger"><b> ${{ $pro->selling_price }} </b></span>
									@else
									 <div class="product_price discount">${{ $pro->discount_price }}<span>${{ $pro->selling_price }}</span></div>
									@endif
									{{-- <div class="product_price">$225</div> --}}


									<div class="product_name"><div><a href="{{ url('product/details/'.$pro->id.'/'.$pro->product_name) }}" tabindex="0">{{ $pro->product_name }}</a></div></div>
								</div>
						

								<ul class="product_marks">
									 @if($pro->discount_price == NULL)
									         <li class="product_mark product_new" style="background: blue;">New</li>
									         @else
									        @php
									        $amount=$pro->selling_price - $pro->discount_price;
									        $discount=$amount/$pro->selling_price * 100;
									        @endphp 
									         <li class="product_mark product_new" style="background: red;">
									       
									       {{ intval($discount) }}%
									        </li>
									@endif

								</ul>
							</div>
							@endforeach



						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							<div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
							 
							<div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	
	
	

	
	

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="{{ asset('public/frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('public/frontend/js/shop_custom.js') }}"></script>
@endsection