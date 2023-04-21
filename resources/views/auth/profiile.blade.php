@extends('Admin.layouts.admin_master')
@section('admin_main_content')
    <div class="pcoded-content">
        <div class="card" style="margin: 30px">
            <div class="card-header">
                <h5>Profile Image</h5>
            </div>
            <div class="card-block">
                <!-- Basic group add-ons start -->
                <div class="m-b-20">
                    @if (session()->has('password_message_type'))
                        <div class="alert alert-success background-{{ session()->get('password_message_type') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            <strong>{{ session()->get('password_message_data') }}</strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-8 col-lg-10">
                            <div class="slim" style="border-radius: 50%; height: 400px;width: 400px"
                                data-label="drag your image here" data-ratio="1:1"
                                data-service="{{ route('profile.picture.update', ['_token' => csrf_token()]) }}"
                                data-size="200,200">

                                <input type="file" name="slim[]" required />
                                <br><br>
                            </div>

                        </div>
                    </div>
                    {{-- <button type="submit" style="margin-left: 0%;margin-top: 1%"
                        class="btn waves-effect waves-light btn-primary btn-square">update
                        profile</button> --}}
                </div>
            </div>
        </div>

        <div class="card" style="margin: 30px">
            <form action="{{ route('email.update') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>Email Section</h5>
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
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h5>Password Section</h5>
                </div>
                <div class="card-block">
                    <!-- Basic group add-ons start -->
                    <div class="m-b-20">
                        @if (session()->has('password_message_type'))
                            <div class="alert alert-success background-{{ session()->get('password_message_type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                <strong>{{ session()->get('password_message_data') }}</strong>
                            </div>
                        @endif
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Your Old Password</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-key"></i></label>
                                    </span>
                                    <input type="password" class="form-control" name="old_password" id="old_password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Your New Password</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-key"></i></label>
                                    </span>
                                    <input type="password" class="form-control" name="new_password" id="new_password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-key"></i></label>
                                    </span>
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn waves-effect waves-light btn-primary btn-square">Update
                            Password</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            window.addEventListener('DOMContentLoaded', function(event) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
    @endsection
