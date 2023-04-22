@extends('Admin.layouts.admin_master')
@section('admin_main_content')
    <div class="pcoded-content">

        <div class="card" style="margin: 30px">
            <div class="card-header">
                <h5>System Setting</h5>
            </div>

            <div class="card-block">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="font-size: 20px;margin-top: 3px;">Project Title</label>
                    <div class="col-sm-4">
                        <input type="text" style="height: 50px;font-weight: bold;font-size: 20px" name="txt_project_name"
                            id="txt_project_name" class="form-control form-control-round form-control-center"
                            placeholder="Project Title" value="{{ Session::get('project_name') }}">
                    </div>

                </div>
            </div>

            <div class="card-block">
                <!-- Basic group add-ons start -->
                <div class="m-b-20">
                    <div class="form-group row">
                        <label class="col-lg-2 col-sm-2 col-form-label" style="font-size: 25px;margin-top: 7%;">Project
                            Logo:- </label>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <div class="slim" data-label="drag your image here" data-ratio="1:1"
                                data-service="{{ route('project.logo.settings', ['_token' => csrf_token()]) }}"
                                data-size="200,200">
                                <img src="{{ url('/media/project_logos') . '/' . Session::get('project_logo') }}"
                                    alt="profile picture">

                                <input type="file" name="slim[]" required />
                            </div>
                        </div>
                        <label class="col-lg-2 offset-lg-2 col-sm-2 col-form-label"
                            style="font-size: 25px;margin-top: 7%;">app Icon:- </label>
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <div class="slim" data-label="drag your image here" data-ratio="1:1"
                                data-service="{{ route('app.logo.settings', ['_token' => csrf_token()]) }}"
                                data-size="200,200">
                                <img src="{{ url('/media/app_icon') . '/' . Session::get('app_icon') }}"
                                    alt="profile picture">

                                <input type="file" name="slim[]" required />
                            </div>
                        </div><br><br>
                    </div>
                </div>
            </div>

            {{-- <div class="card-block">
                <!-- Basic group add-ons start -->
                <div class="m-b-20">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" style="font-size: 20px;margin-top: 10%;">Project Logo</label>
                        <div class="col-lg-2 col-sm-4">
                            <div class="slim" data-label="drag your image here" data-ratio="1:1"
                                data-service="{{ route('app.logo.settings', ['_token' => csrf_token()]) }}"
                                data-size="200,200">
                                <img src="{{ url('/app_icon') . '/' . Session::get('app_icon') }}" alt="profile picture">

                                <input type="file" name="slim[]" required />
                                <br><br>
                            </div>

                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="card-block">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" style="font-size: 20px;margin-top: 3px;">Project Theme</label>
                    <div class="col-sm-4">
                        <select style="height: 50px;font-weight: bold;font-size: 20px;border: 0.1px solid gray;"
                            name="txt_theme" id="txt_theme" class="form-control form-control-round form-control-center"
                            value="{{ session()->get('theme') }}">
                            <option value="White">White</option>
                            <option value="Black">Black</option>
                            <option value="Blue">Blue</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 mb-4 col-sm-5">
                <button type="button" class="btn btn-primary btn-round waves-effect waves-light" name="btn_add_app_name"
                    id="btn_add_app_name" style="height: 50px"><i class="fa fa-plus" aria-hidden="true"></i>Apply
                    Changes</button>
            </div>

        </div>
        <div class="card" style="margin: 30px">
            <form action="{{ route('email.update') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>Admin Email</h5>
                </div>
                <div class="card-block">
                    <!-- Basic group add-ons start -->
                    <div class="m-b-20">
                        @if (session()->has('email_message_type'))
                            <div class="alert alert-success background-{{ session()->get('email_message_type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                <strong>{{ session()->get('email_message_data') }}</strong>
                            </div>
                        @endif
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Your Email</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text">@</label>
                                    </span>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $userdata['email'] }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-square">Update
                            Email</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card" style="margin: 30px">
            <form action="{{ route('mobile.number.update') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>Admin Mobile Number</h5>
                </div>
                <div class="card-block">
                    <!-- Basic group add-ons start -->
                    <div class="m-b-20">
                        @if (session()->has('number_message_type'))
                            <div class="alert alert-success background-{{ session()->get('number_message_type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                <strong>{{ session()->get('number_message_data') }}</strong>
                            </div>
                        @endif
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Your Mobile Number</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i>
                                        </label>
                                    </span>
                                    <input type="number" class="form-control" name="new_mobile_number"
                                        id="new_mobile_number" value="{{ session()->get('mobile_number') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-square">Update
                            Number</button>
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

                $('#btn_add_app_name').click(function() {
                    let project_name = document.getElementById("txt_project_name").value;
                    let project_theme = document.getElementById("txt_theme").value;
                    $.ajax({
                        type: 'POST',
                        method: 'POST',
                        url: "{{ route('set.system.settings') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            project_name: project_name,
                            project_theme: project_theme
                        },
                        success: function(data) {
                            Swal.fire(
                                'Updated!',
                                'System Setting has been Updated.',
                                'success'
                            ).then(function() {
                                // location.reload()
                            })
                        }
                    });
                });

            });
        });
    </script>
@endsection
