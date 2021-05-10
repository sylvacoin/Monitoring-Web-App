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
        <!--begin::Forgot-->
        <div class="login-form">
            <div class="text-center mb-10 mb-lg-20">
                <h3 class="font-size-h1">Forgotten Password ?</h3>
                <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
            </div>
            <!--begin::Form-->
            <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-5 px-6" type="email" placeholder="Email" name="email" autocomplete="off" />
                </div>
                <div class="form-group d-flex flex-wrap flex-center">
                    <button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Submit</button>
                    <button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Forgot-->
    </div>
    <!--end::Content body-->

@endsection

