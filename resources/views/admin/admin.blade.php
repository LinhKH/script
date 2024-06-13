<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Traveller</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('public/assets/css/sweetalert-bootstrap-4.min.css')}}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                @php $siteInfo = site_settings();  @endphp
                                @if($siteInfo->com_logo != '')
                                    <img src="{{asset('public/site-img/'.$siteInfo->com_logo)}}" >
                                @else
                                    <h3>{{$siteInfo->com_name}}</h3>
                                @endif
                            </div>
                            <form class="pt-3" id="adminLogin" method="POST">
                                @csrf
                                <input type="hidden" class="url" value="{{url('/')}}">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-sm" name="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-sm btn-gradient-primary">Login</button>
                                    <!-- <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a> -->
                                </div>
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if(Session::has('loginError'))
                                        <div class="alert alert-danger">
                                            {{Session::get('loginError')}}
                                        </div>
                                    @endif
                                </div>
                                <!-- /.col -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/assets/js/sweetalert2.min.js')}}"></script>
    <!-- plugins:js -->
    <!-- <script src="{{asset('public/assets/js/vendor.bundle.base.js')}}"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('public/assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <script src="{{asset('public/assets/js/admin-login.js')}}"></script>
    <input type="hidden" class="site-url" value="{{url('/admin')}}"></input>
</body>
</html>