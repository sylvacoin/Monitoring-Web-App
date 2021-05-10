@extends('layouts.auth')

@section('content')
    <!--begin::Content header-->
    <div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
        <span class="font-weight-bold text-dark-50">Already have an account?</span>
        <a href="{{route('login')}}" class="font-weight-bold ml-2">Sign In!</a>
    </div>
    <!--end::Content header-->
    <!--begin::Content body-->
    <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
        <!--begin::Signup-->
        <div class="login-form">
            <div class="text-center mb-10 mb-lg-20">
                <h3 class="font-size-h1">Sign Up</h3>
                <p class="text-muted font-weight-bold">Enter your details to create your account</p>
            </div>
            <!--begin::Form-->
            <form method="POST" action="{{ route('register') }}" class="form" novalidate="novalidate" id="kt_login_signup_form">
                @csrf
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-5 px-6" type="text" placeholder="Fullname" value="{{ old('name') }}" required autocomplete="name" autofocus name="name" />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="email" type="email"  class="form-control form-control-solid h-auto py-5 px-6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror

                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control form-control-solid h-auto py-5 px-6 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <div class="form-group">
                    <label class="checkbox mb-0">
                        <input type="checkbox" name="agree" />
                        <span></span>I Agree the
                        <a href="#">terms and conditions</a></label>
                </div>
                <div class="form-group d-flex flex-wrap flex-center">
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
                    <button type="reset" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signup-->
    </div>
    <!--end::Content body-->
@endsection
