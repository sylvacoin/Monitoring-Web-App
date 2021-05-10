@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">Create Job</h3>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form action="{{route('job.create')}}" id="kt_create_job" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body pt-0">
                        <div class="form-group">
                            <label>Job Title
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Job Title" required name="title" id="title"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Job Description
                                <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" required rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Job Requirements
                                <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="requirement" name="requirement" required rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Job Salary
                                <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Job Salary" required name="salary" id="salary"/>
                        </div>
                        <div class="form-group">
                            <label>Company Name
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Company Name" required name="company_name" id="company_name"/>
                        </div>
                        <div class="form-group">
                            <label>Company Address
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Company address" required name="company_address" id="company_address"/>
                        </div>
                        <div class="form-group">
                            <label>Company Phone
                                <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" placeholder="Company phone" required name="company_phone" id="company_address"/>
                        </div>
                        <div class="form-group">
                            <label>Company Email
                                <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Company email" required name="company_email" id="company_email"/>
                        </div>
                        <div class="form-group">
                            <label>Company Logo
                                <span class="text-danger">*</span></label>
                            <input type="file" name="company_logo" id="company_logo" required class="form-control-file"/>
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
                    <h3 class="card-title font-weight-bolder text-dark">All Jobs</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 table-responsive">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Job Title</th>
                            <th>Salary</th>
                            <th>Company Name</th>
                            <th>Status</th>
                            <th>No of Applicants</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($jobs) && count($jobs) > 0 )
                            <?php $i = 1  ?>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$job->title}}</td>
                                    <td>{{ $job->salary }}</td>
                                    <td>{{ $job->company_name }}</td>
                                    <td>{{$job->is_open?"Active": "Completed"}}</td>
                                    <td></td>
                                    <td>{{$job->created_at}}</td>
                                    <td>
                                        <a href="" data-id="{{$job->id}}">Edit</a> | <a href="" data-id="{{$job->id}}" class="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"> No job has been added</td>
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
        $(document).on('submit', '#kt_create_job', function(e){
            e.preventDefault();
            let form = $(this)[0];
            var formData = new FormData(form);
            //formData.append('company_logo', $('#company_logo')[0].files[0]);
            $.ajax({
                url: '{{route('job.create')}}',
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
                url: '{{route('job.delete')}}',
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

