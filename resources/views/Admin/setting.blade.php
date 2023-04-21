@extends('Admin.layouts.admin_master')
@section('admin_main_content')
    <div class="pcoded-content">
        <div class="card" style="margin: 30px">
            <div class="card-header">
                <h5>App Icon</h5>
            </div>
            <div class="card-block">
                <!-- Basic group add-ons start -->
                <div class="m-b-20">
                    <div class="row">
                        <div class="col-sm-8 col-lg-10">
                            <div class="slim" style=" height: 400px;width: 400px"
                                data-label="drag your image here" data-ratio="1:1"
                                data-service="{{ route('app.logo.settings', ['_token' => csrf_token()]) }}"
                                data-size="200,200">
                                <img src="{{ url('/app_icon') . '/' . Session::get('app_icon') }}" alt="profile picture">

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
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Theme setting</h5>
                                </div>
                                <label for="them_name"></label>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                            <h4 class="sub-title">Dark Theme</h4>
                                            <input type="checkbox" class="js-single" id="dark_theme" checked />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Theme setting</h5>
                                </div>
                                <label for="them_name"></label>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            style="font-size: 20px;margin-top: 3px;">Round Input</label>
                                        <div class="col-sm-5">
                                            <input type="text" style="height: 50px;font-weight: bold;font-size: 20px"
                                                name="txt_app_name" id="txt_app_name"
                                                class="form-control form-control-round form-control-center"
                                                placeholder="App Name">
                                        </div>
                                        <div class="col-sm-5">
                                            <button class="btn btn-primary btn-round waves-effect waves-light"
                                                name="btn_add_app_name" id="btn_add_app_name" style="height: 50px"><i
                                                    class="fa fa-plus" aria-hidden="true"></i>Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

                $('#dark_theme').change(function() {
                    let checkbox = document.getElementById("dark_theme");
                    var theme = ""
                    if (checkbox.checked) {
                        theme = "black";
                    } else {
                        theme = "white";
                    }
                    $.ajax({
                        type: 'POST',
                        method: 'POST',
                        url: "{{ route('theme.settings') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            theme: theme,
                        },
                        success: function(data) {}
                    });
                });



            });
        });
    </script>
@endsection
