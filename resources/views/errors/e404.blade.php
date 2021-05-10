@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <!--begin::List Widget 7-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">404 Not found</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0">
                    <p>{{$message}}</p>
                    <p><a href="{{route('dashboard')}}"> Home </a></p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::List Widget 7-->
        </div>
    </div>
@endsection
