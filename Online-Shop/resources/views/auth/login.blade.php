@extends('layouts.app')

@section('content')


                                 <!--Coustomer Login Form --> 

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css')}}">
<div class="contact_form">
<div class="container">
<div class="row">
<div class="col-lg-5 offset-lg-1"  style="border: 5px solid grey; padding: 20px;">
<div class="contact_form_container">
<div class="contact_form_title text-center">Login</div>

<form action="{{ route('login') }}" id="contact_form" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Email Or Phone</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="Email Or Phone" required="">
        @error('email')
           <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
           </span>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail1">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required=""  aria-describedby="emailHelp" placeholder="Password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="contact_form_button">
        <button type="submit" class="btn btn-success">Login</button>
    </div>
</form><br>
<a href="{{ route('password.request') }}">I Forgot My Password.</a>
<br><br>
<a href="{{ url('/auth/redirect/facebook') }}"><button type="submit" class="btn btn-primary btn-block">Login With Facebook</button></a></br>
<a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block">Login With Google</a>
</div>
</div>





                            <!--Coustomer Register Form --> 


  <div class="col-lg-5 offset-lg-1" style="border: 5px solid grey; padding: 20px;">
   <div class="contact_form_container">
     <div class="contact_form_title text-center">Register</div>

       <form action="{{ route('register') }}" id="contact_form" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name </label>
                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Full Name" name="name" required="">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Phone </label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  aria-describedby="emailHelp" placeholder="Phone" required="">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="Email" required="">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control"  aria-describedby="emailHelp" placeholder="Password" name="password" required="">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Confirm Password</label>
                <input type="password" class="form-control"  aria-describedby="emailHelp" placeholder="Re-type Password" name="password_confirmation" required="">
            </div>

            <div class="contact_form_button">
                <button type="submit" class="btn btn-info">SIgnUp</button>
            </div>
       </form>
     </div>
   </div>
  </div>
</div>
<div class="panel"></div>
</div>
@endsection
