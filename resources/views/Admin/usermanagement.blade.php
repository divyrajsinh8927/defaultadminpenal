@extends('Admin.layouts.admin_master')
@section('admin_main_content')
    <div class="pcoded-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    @if (is_array(session()->has('add_form_error')))
                        @foreach (session()->get('add_form_error') as $error)
                            <div class="alert alert-success background-{{ session()->get('add_form_error_type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif
                    @if (session()->has('add_form_error'))
                        <div class="alert alert-success background-{{ session()->get('add_form_error_type') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            <strong>{{ session()->get('add_form_error') }}</strong>
                        </div>
                    @endif
                    <!-- Page-body start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Users Table</h5>
                            <button type="button" style="float: right;margin-right: 2%;font-size: 20px;"
                                class="btn btn-primary waves-effect" data-toggle="modal" data-target="#add-Modal"><i
                                    class="fa fa-user-plus" style="margin-right: 0px"></i> Add</button>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive p-4">
                                <div id="multi-colum-dt_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <table id="tbl_user"
                                                class="table table-striped table-bordered nowrap dataTable" role="grid"
                                                aria-describedby="multi-colum-dt_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_desc" tabindex="0"
                                                            aria-controls="multi-colum-dt" rowspan="1" colspan="1"
                                                            aria-label="Name: activate to sort column ascending"
                                                            style="width: 138.115px;" aria-sort="descending">Id</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-colum-dt"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Position: activate to sort column ascending"
                                                            style="width: 211.24px;">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-colum-dt"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Office: activate to sort column ascending"
                                                            style="width: 96.7812px;">Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-colum-dt"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Age: activate to sort column ascending"
                                                            style="width: 38.1042px;">Mobile Number</th>
                                                        <th class="sorting" tabindex="0" aria-controls="multi-colum-dt"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Salary: activate to sort column ascending"
                                                            style="width: 60.1458px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="userList">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Add User Form-->
                <div class="modal fade" id="add-Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="card">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('add.user') }}" method="POST">
                                @csrf
                                <div class="card-block">
                                    <!-- Basic group add-ons start -->
                                    <div class="m-b-20">
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Name</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-user"></i></label>
                                                    </span>
                                                    <input type="text" name="txt_name" id="txt_name"
                                                        class="form-control" placeholder="Enter Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Email</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-envelope"
                                                                aria-hidden="true"></i></label>
                                                    </span>
                                                    <input type="email" name="txt_email" id="txt_email"
                                                        class="form-control" placeholder="Enter Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Mobile Number</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-phone"
                                                                aria-hidden="true"></i>
                                                        </label>
                                                    </span>
                                                    <input type="number" name="txt_mobile_number" id="txt_mobile_number"
                                                        class="form-control" placeholder="Mobile Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">Status</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-user"></i>
                                                        </label>
                                                    </span>
                                                    <select name="select_status" id="select_status" class="form-control"
                                                        style="border: 0.1px solid #ccc;">
                                                        <option value="1">Active</option>
                                                        <option value="2">Blocked</option>
                                                        <option value="3">Archived</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect "
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Save
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Icon Group Addons end -->
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!--Update Form-->
                <div class="modal fade" id="update-Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="card">
                            <div class="modal-header">
                                <h4 class="modal-title">Update User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="frm_update_user">
                                @csrf
                                <div class="card-block">
                                    <!-- Basic group add-ons start -->
                                    <div class="m-b-20">
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Name</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-user"></i></label>
                                                    </span>
                                                    <input type="hidden" name="txt_update_id" id="txt_update_id">
                                                    <input type="text" name="txt_update_name" id="txt_update_name"
                                                        class="form-control" placeholder="Enter Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Email</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-envelope"
                                                                aria-hidden="true"></i></label>
                                                    </span>
                                                    <input type="email" name="txt_update_email" id="txt_update_email"
                                                        class="form-control" placeholder="Enter Email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Mobile Number</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-phone"
                                                                aria-hidden="true"></i>
                                                        </label>
                                                    </span>
                                                    <input type="number" name="txt_update_mobile_number"
                                                        id="txt_update_mobile_number" class="form-control"
                                                        placeholder="Mobile Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">Status</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-user"></i>
                                                        </label>
                                                    </span>
                                                    <select name="select_update_status" id="select_update_status"
                                                        class="form-control" style="border: 0.1px solid #ccc;">
                                                        <option value="1">Active</option>
                                                        <option value="2">Blocked</option>
                                                        <option value="3">Archived</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default waves-effect "
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Save
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Icon Group Addons end -->
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    window.addEventListener('DOMContentLoaded', function(event) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $(document).ready(function() {

                            search_param = {};
                            var table = $('#tbl_user').DataTable({
                                processing: true,
                                serverSide: true,
                                deferRender: true,
                                orderCellsTop: true,
                                scrollX: false,

                                ajax: function(data, callback) {
                                    $.each(search_param, function(k, v) {});
                                    data._token = "{{ csrf_token() }}"
                                    $.ajax({
                                        url: "{{ route('get.user') }}",
                                        data: data,
                                        type: "post",
                                        dataType: 'json',
                                        beforeSend: function() {},
                                        success: function(res) {
                                            callback(res);
                                            $('#tbl_user_info').html(
                                                "<b style='font-size: 15px;'>Found </b>&nbsp&nbsp<b style='font-size: 20px;'>" +
                                                res.displayedUsers +
                                                "</b> &nbsp&nbsp<b style='font-size: 15px;'> From Total </b>&nbsp&nbsp<b style='font-size: 20px;'>" +
                                                res.totalUsers +
                                                "</b><b style='font-size: 15px;'>  &nbsp&nbspProducts </b>"
                                            );
                                        }
                                    });
                                },
                                language: {
                                    processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> <span class="sr-only" style="display:contents;"> Loading...</span>'
                                },
                                lengthMenu: [
                                    [5, 10, 25, 50, 100, 150, 250, 500, 1000, 1500, -1],
                                    [5, 10, 25, 50, 100, 150, 250, 500, 1000, 1500, 'All']
                                ],
                                'columns': [{
                                        'data': 'id',
                                    },
                                    {
                                        'data': 'name',
                                    },
                                    {
                                        'data': 'email',
                                    },
                                    {
                                        'data': 'mobile_no',
                                    },
                                    {
                                        'data': 'id',
                                        'orderable': false,
                                        render: function(data, type, row, meta) {
                                            return '<button class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#update-Modal" data-id="' +
                                                data +
                                                '" id="edit_user"><i class="icofont icofont-pencil" style="font-size:20px"></i></button>&nbsp<button class="btn waves-effect waves-light btn-danger" id="DeleteButton" style="align-item: center; " data-id="' +
                                                data + '"><i class="fa fa-trash"> </i></button>';
                                        }
                                    }
                                ]
                            });

                        });

                        $(document).on('click', '#edit_user', function() {
                            update_user_Id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('edit.user') }}",
                                data: {
                                    id: update_user_Id
                                },
                                success: function(data) {
                                    $('#txt_update_id').val(data.id);
                                    $('#txt_update_name').val(data.name);
                                    $('#txt_update_email').val(data.email);
                                    $('#txt_update_mobile_number').val(data.mobile_no);
                                    $('#select_update_status').val(data.status);
                                }
                            });
                        });

                        $('#frm_update_user').submit(function(e) {
                            e.preventDefault();

                            var updateFormData = new FormData(this);
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('update.user') }}",
                                data: updateFormData,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    if ($.isEmptyObject(data.error)) {
                                        Swal.fire(
                                            'Updated!',
                                            'User has been Updated.',
                                            'success'
                                        ).then(function() {
                                            location.reload();
                                        })
                                    } else {
                                        printUpdateErrorMsg(data.error);
                                    }
                                }
                            });
                        });

                        $(document).on('click', '#DeleteButton', function() {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't to Delete User!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var id = $(this).data('id');
                                    $.ajax({
                                        type: 'POST',
                                        method: 'POST',
                                        url: "{{ route('delete.user') }}",
                                        data: {
                                            "_token": "{{ csrf_token() }}",
                                            id: id,
                                        },
                                        success: function(data) {
                                            if (data.error) {
                                                Swal.fire(
                                                    'Not Deleted!',
                                                    data.error,
                                                    'error'
                                                ).then(function() {})
                                            } else {
                                                Swal.fire(
                                                    'Deleted!',
                                                    'User has been deleted.',
                                                    'success'
                                                ).then(function() {
                                                    location.reload()
                                                })
                                            }
                                        }
                                    });
                                }
                            })
                        });

                    });
                </script>
            @endsection
