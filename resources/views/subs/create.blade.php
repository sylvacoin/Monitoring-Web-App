@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">Create a subscription plan</h3>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form action="{{route('subs.create')}}" id="kt_create_package" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body pt-0">
                        <div class="form-group">
                            <label>Subscription
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Package Title" required name="title" id="title"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount
                                <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Package amount" required name="amount" id="amount"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Timeframe
                                <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="How many days" required name="timeframe" id="timeframe"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <div class="col-8">
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">All Subscriptions</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 table-responsive">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>TimeFrame</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($subscriptions) && count($subscriptions) > 0 )
                            <?php $i = 1  ?>
                            @foreach($subscriptions as $subs)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$subs->title}}</td>
                                    <td>${{ $subs->amount }}</td>
                                    <td>{{ $subs->timeframe }} day(s)</td>
                                    <td>{{$subs->status}}</td>
                                    <td>{{$subs->created_at}}</td>
                                    <td>
                                        @if($subs->status == 'enabled')
                                            <a href="" data-id="{{$subs->id}}">Disable</a>
                                        @else
                                            <a href="" data-id="{{$subs->id}}">Disable</a>
                                        @endif
                                            | <a href="" data-id="{{$subs->id}}" class="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"> No subscriptions has been added</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/dist/assets/plugins/custom/datatables/datatables.bundle1ff3.js?v=7.1.2"></script>
    <script type="text/javascript">
        $(document).on('submit', '#kt_create_package', function(e){
            e.preventDefault();
            let form = $(this)[0];
            var formData = new FormData(form);
            //formData.append('company_logo', $('#company_logo')[0].files[0]);
            $.ajax({
                url: '{{route('subs.create')}}',
                type: 'POST',
                data: formData,
                processData:false,
                contentType: false,
                success: function(res){
                    if (res.success)
                    {
                        toastr.success(res.message);
                        window.location.reload();
                    }

                },
                error: function(res){
                    console.log(res);
                    $.each(res.responseJSON.message, function(idx, err){
                        toastr.error(err);
                    })

                }
            })
        });
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            alert(id);
            $.ajax({
                url: '{{route('subs.delete')}}',
                type: 'POST',
                data: { id: id,"_token": "{{ csrf_token() }}"},
                success: function(res){
                    if (res.success)
                    {
                        toastr.success(res.message);
                        window.location.reload();
                    }

                },
                error: function(res){
                    console.log(res);
                    $.each(res.responseJSON.message, function(idx, err){
                        toastr.error(err);
                    })

                }
            })
        });
        $('#kt_datatable').dataTable();
    </script>
@endsection

