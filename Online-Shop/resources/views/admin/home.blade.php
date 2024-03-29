@extends('admin.admin_layouts')

@section('admin_content')

@php
$date=date("d-m-y");
$month=date("F");
$year=date("Y");

$today=DB::table('orders')->where('date',$date)->sum('total');
$delevery=DB::table('orders')->where('date',$date)->where('status',3)->sum('total');
$month=DB::table('orders')->where('month',$month)->sum('total');
$year=DB::table('orders')->where('year',$year)->sum('total');
@endphp


    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
          

          <div class="col-sm-6 col-xl-3">
            <div class="card pd-20 bg-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Order</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div>
              <div class="d-flex align-items-center justify-content-between">
      
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ $today }}</h3>
              </div>
            </div>
          </div>





          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="card pd-20 bg-info">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Tody Delevered</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div>
              <div class="d-flex align-items-center justify-content-between">
   
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{$delevery}}</h3>
              </div>
            </div>
          </div>




          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month Sales</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
   
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{$month}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div>




          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Year's Sales</h6>
                <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
         <!--        <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> -->
                <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{$year}}</h3>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

       

      </div><!-- sl-pagebody -->
     
    </div><!-- sl-mainpanel -->
@endsection
