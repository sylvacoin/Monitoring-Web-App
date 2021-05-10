@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-xl-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="row justify-content-center my-20">
                    @if(isset($subscriptions) && !empty($subscriptions) && count($subscriptions) > 0 )
                        @foreach($subscriptions as $subs)
                            <!--begin: Pricing-->
                            <div class="col-md-4 col-xxl-3">
                                <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                                    <!--begin::Icon-->
                                    <div class="d-flex flex-center position-relative mb-25">
                                        <span class="svg svg-fill-primary opacity-4 position-absolute">
                                            <svg width="175" height="200">
                                                <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0" />
                                            </svg>
                                        </span>
                                        <span class="svg-icon svg-icon-5x svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Home/Flower3.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <path d="M1.4152146,4.84010415 C11.1782334,10.3362599 14.7076452,16.4493804 12.0034499,23.1794656 C5.02500006,22.0396582 1.4955883,15.9265377 1.4152146,4.84010415 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M22.5950046,4.84010415 C12.8319858,10.3362599 9.30257403,16.4493804 12.0067693,23.1794656 C18.9852192,22.0396582 22.5146309,15.9265377 22.5950046,4.84010415 Z" fill="#000000" opacity="0.3" />
                                                                <path d="M12.0002081,2 C6.29326368,11.6413199 6.29326368,18.7001435 12.0002081,23.1764706 C17.4738192,18.7001435 17.4738192,11.6413199 12.0002081,2 Z" fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                            <!--end::Svg Icon-->
                                                    </span>
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Content-->
                                    <span class="font-size-h1 d-block d-block font-weight-boldest text-dark-75 py-2">{{$subs->timeframe}} days</span>
                                    <h4 class="font-size-h6 d-block d-block font-weight-bold mb-7 text-dark-50">{{$subs->title}}</h4>
                                    <form method="POST" action="{{ route('paystack.pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                        <input type="hidden" name="email" value="{{session('user.email')}}"> {{-- required --}}
                                        <input type="hidden" name="orderID" value="{{ Str::uuid() }}">
                                        <input type="hidden" name="amount" value="{{$subs->amount*100}}"> {{-- required in kobo --}}
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="currency" value="NGN">
                                        <input type="hidden" name="metadata" value="{{ json_encode(['subscription' => $subs->id]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @php $has_subbed = session('user.has_subscribed') @endphp
                                        @if($has_subbed == 0)
                                        <button type="submit" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Buy</button>{{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                        @endif
                                    </form>

                                    <!--end::Content-->
                                </div>
                            </div>
                            <!--end: Pricing-->
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        <!--end::Card-->
		</div>
</div>
@endsection
