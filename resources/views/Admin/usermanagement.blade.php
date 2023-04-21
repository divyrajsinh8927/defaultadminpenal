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
                                class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal"><i
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
                                                            aria-label="Start date: activate to sort column ascending"
                                                            style="width: 90.2812px;">User Role</th>
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
                <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal title</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('add.user') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header" style="align-self: center">
                                    <h4>Add User</h4>
                                </div>
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
                                            <label class="col-sm-4 col-lg-2 col-form-label">Password</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-key"></i>
                                                        </label>
                                                    </span>
                                                    <input type="password" name="txt_password" id="txt_password"
                                                        class="form-control" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-key"></i>
                                                        </label>
                                                    </span>
                                                    <input type="password" name="txt_confirm_password"
                                                        id="txt_confirm_password" class="form-control"
                                                        placeholder="Confirm Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-lg-2 col-form-label">User Role</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <label class="input-group-text"><i class="fa fa-user"></i>
                                                        </label>
                                                    </span>
                                                    <select name="select_role" id="select_role"
                                                        class="form-control"></select>
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
                            </div>

                        </form>
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
                                        'data': 'role',
                                    },
                                    {
                                        'data': 'id',
                                        'orderable': false,
                                        render: function(data, type, row, meta) {
                                            return '<span class="DeleteButton" style="margin-left: 40%" data-id="' +
                                                data +
                                                '"><i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i></span>';
                                        }
                                    }
                                ]
                            });

                        });

                        var role_option = [
                            '<option value="-1" disabled>Select User Role</option>'
                        ]
                        $.ajax({
                            url: "{{ route('get.user.role') }}",
                            type: "GET",
                            dataType: 'json',
                            success: function(data) {
                                for (var i = 0; i < data.length; i++) {
                                    var row = $('<option value=' + data[i].id + '>' + data[i].role +
                                        '</option>');
                                    role_option.push(row)
                                }
                                $("#select_role").html(role_option);
                            }
                        });

                        $(document).on('click', '.DeleteButton', function() {
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
