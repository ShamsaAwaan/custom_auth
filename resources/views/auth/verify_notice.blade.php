@extends('layouts.auth-layout')

@section('title', 'Verify Your Email')

@section('content')
<div class="auth-page-wrapper pt-5">
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4 text-center">
                            <div class="mt-2">
                                <h3 class="text-primary">Almost There!</h3>
                                <p class="text-muted mt-3 fs-14">We have sent a verification link to your email address.
                                Please check your inbox (and spam folder) and click the link to verify your account.</p>
                                <img src="{{ asset('assets/images/mailbox.png') }}" alt="Check Email" class="img-fluid my-3" style="max-height:150px;">
                                <a href="{{ url('/login') }}" class="btn btn-success w-100 mt-3">Back to Login</a>
                            </div>
                        </div>

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
