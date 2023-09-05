@extends('layouts.home')
@section('title', '500 Error Page')
@section('header', '500 Error Page')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active">500 Error Page</li>
</ol>
@endsection
@section('content')
<section class="content">
    <div class="error-page">
        <h2 class="headline text-danger"> 500</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger mt-4"></i> Oops! Something went wrong.</h3>

            <p>
                We will work on fixing that right away.
                Meanwhile, you may <a href="{{route('home')}}">return to home
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<!-- /.content -->
@endsection