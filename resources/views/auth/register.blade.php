@extends('layouts.auth')

@section('title','Register')

@section('content')

    <!-- your velzon signup html here -->

<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Create New Account</h5>
                                <p class="text-muted">Get your free velzon account now</p>
                            </div>

                            <div class="p-2 mt-4">
                                @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif



                                <!-- Laravel Form -->

                               <form method="POST" action="{{ url('/register') }}">

                                    @csrf

                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-input" class="form-label">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Already have an account?
                                            <a href="{{ url('/login') }}" class="fw-semibold text-primary text-decoration-underline">Signin</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>  <!-- end card -->
                </div>
            </div>
        </div>
    </div><!-- footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
        </div>
    </footer>
</div>
@endsection



