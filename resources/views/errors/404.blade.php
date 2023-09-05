@extends('layouts.home')
@section('title', '404 Error Page')
@section('header', '404 Error Page')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">404 Error Page</li>
</ol>
@endsection
@section('content')
<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning mt-4"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{route('home')}}">return to home
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<!-- /.content -->
@endsection