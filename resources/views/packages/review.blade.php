@extends('layouts.admin')

@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Application(s)</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{count($applications)}} Total</span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
        @if(isset($applications) && !empty($applications) && count($applications) > 0)
            @foreach($applications as $app)
                <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <!--begin::Top-->
                            <div class="d-flex">
                                <!--begin::Pic-->
                                <div class="flex-shrink-0 mr-7">

                                    <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                                        <span class="font-size-h3 symbol-label font-weight-boldest">{{strtoupper(substr($app->name, 0,2))}}</span>
                                    </div>

                                </div>
                                <!--end::Pic-->
                                <!--begin: Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                        <!--begin::User-->
                                        <div class="mr-3">
                                            <!--begin::Name-->
                                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$app->name}}
                                                <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                            <!--end::Name-->

                                        </div>
                                        <!--begin::User-->
                                        <!--begin::Actions-->
                                        <div class="my-lg-0 my-1">
                                            @if($app->status != 5)
                                                <select name="status" class="form-control change-status" data-id="{{$app->id}}">
                                                    <option value="1" @if($app->status == 1) selected @endif>Awaiting Review</option>
                                                    <option value="2" @if($app->status == 2) selected @endif>Awaiting Document Upload</option>
                                                    <option value="3" @if($app->status == 3) selected @endif>Awaiting Document Review</option>
                                                    <option value="4" @if($app->status == 4) selected @endif>Awaiting Disbursement</option>
                                                    <option value="5" @if($app->status == 5) selected @endif>Disbursed & Completed</option>
                                                </select>
                                            @endif
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Content-->
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <!--begin::Description-->
                                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                            <div class="mb-10">
                                                <h6>Description</h6>
                                                <p>{{$app->description}}</p>
                                            </div>
                                            <div class="mt-10">
                                                <h6>Requirements</h6>
                                                <p>{{$app->requirements}}</p>
                                            </div>
                                        </div>

                                        <!--end::Description-->
                                        <!--begin::Progress-->
                                        @php
                                            $done = $app->status;
                                            $percentageDone = (($done/5)*100);
                                        @endphp
                                        <div>
                                            <div class="d-flex mt-4 mt-sm-0">
                                                <span class="font-weight-bold mr-4">Progress</span>
                                                <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$percentageDone}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="font-weight-bolder text-dark ml-4">{{$percentageDone}}%</span>
                                            </div>
                                            <p>{{$app->stage}}</p>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Top-->
                            <!--begin::Separator-->
                            <div class="separator separator-solid my-7"></div>
                            <!--end::Separator-->
                            <!--begin::Bottom-->
                            <div class="d-flex align-items-center flex-wrap">
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                <span class="mr-4">
                                    <i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                                </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">Amount</span>
                                        <span class="font-weight-bolder font-size-h5">
                                    <span class="text-dark-50 font-weight-bold">$</span>{{$app->amount}}</span>
                                    </div>
                                </div>
                                <!--end: Item-->
                            </div>
                            <!--end::Bottom-->
                        </div>
                    </div>
                    <!--end::Card-->
                @endforeach
            @else
                <p class="text-center"> No application available at the moment</p>
            @endif
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).on('change', '.change-status', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let status = $(this).val();
            let route = '{{route('packages.update')}}';

            $.ajax({
                url:route,
                type:'POST',
                data: {'package_id': id, 'status':status, '_token':'{{csrf_token()}}'},
                success: function(res){
                    toastr.success(res.message);
                    window.location.reload();
                },
                error: function (res) {
                    $.each(res.responseJSON.message, function(idx, err){
                        toastr.error(err);
                    })
                }
            })
        });
    </script>
@endsection
