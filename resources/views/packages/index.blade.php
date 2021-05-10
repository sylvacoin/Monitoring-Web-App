@extends('layouts.admin')

@section('content')
    <div class="container">
        <!--begin::Container-->
        <div class="row">
            <div class="col-xl-12">
                <!--begin::List Widget 7-->
                <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <!--begin::Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Packages</h5>
                                <!--end::Title-->
                                <!--begin::Separator-->
                                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Search Form-->
                                <div class="d-flex align-items-center" id="kt_subheader_search">
                                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ count($packages) }} Total</span>
                                </div>
                                <!--end::Search Form-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0 table-responsive">
                            <table id="kt_datatable" class="table table-bordered" width="100%">
                                <thead class="table-head-solid">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Package Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($packages) && !empty($packages) && count($packages) > 0)
                                    <?php $i = 1 ?>
                                    @foreach($packages as $package)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$package->name}}</td>
                                            <td>{{$package->amount}}</td>
                                            <td>{{$package->is_open? 'Open':'Closed'}}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-bg-primary btn-xs apply text-white" data-id="{{$package->id}}">Apply</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center"> No package available at the moment</p>
                                        </td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!--end::Body-->
                    </div>
                <!--end::List Widget 7-->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/dist/assets/plugins/custom/datatables/datatables.bundle1ff3.js?v=7.1.2"></script>
    <script type="text/javascript">
        $(document).on('click', '.apply', function(e){
            e.preventDefault();

            let id = $(this).data('id');
            let route = '{{route('packages.apply')}}';

            $.ajax({
                url:route,
                type:'POST',
                data: {'package_id': id, '_token':'{{csrf_token()}}'},
                success: function(res){
                    toastr.success(res.message);
                },
                error: function (res) {
                    $.each(res.responseJSON.message, function(idx, err){
                        toastr.error(err);
                    })
                }
            })
        })
        $('#kt_datatable').dataTable();
    </script>
@endsection
