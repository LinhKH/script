<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{site_settings()->com_name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
     <!-- DataTables -->
     <link rel="stylesheet" href="{{asset('public/assets/css/dataTables.bootstrap4.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/assets/fontawesome-free/css/all.min.css')}}">
    <!-- Tokenfield for Bootstrap-->
    <link rel="stylesheet" href="{{asset('public/assets/css/tokenfield.css')}}">
    <!-- DateTime picker -->
    <link rel="stylesheet" href="{{asset('public/assets/css/jquery.datetimepicker.min.css')}}">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('public/assets/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/sweetalert-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('public/assets/css/image-uploader.css')}}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <!-- End layout styles -->
    <style>
        .page-checkbox{
        display: inline-block;
        position: relative;
        }
        .page-checkbox input[type=checkbox]{
            margin: 0;
            visibility: hidden;
            position: absolute;
            left: 1px;
            top: 1px;
        }
        .page-checkbox label{
            width: 35px;
            height: 22px;
            margin: 0;
            border: 3px solid #555;
            border-radius: 100px;
            cursor: pointer;
            display: block;
            overflow: hidden;
            position: relative;
            transition: all 0.75s ease;
        }
        .page-checkbox label:before,
        .page-checkbox label:after{
            content: '';
            background: #555;
            border-radius: 50px;
            width: 14px;
            height: 14px;
            position: absolute;
            top: 1px;
            left: 2px;
            opacity: 1;
            transition: 0.75s ease;
        }
        .page-checkbox label:after{
            left: auto;
            right: 2px;
            opacity: 0;
        }
        .page-checkbox input[type=checkbox]:checked+label{
            border-color: #a30d9e;
            box-shadow: 0 0 5px rgba(163,13,158,0.4);
        }
        .page-checkbox input[type=checkbox]:checked+label:before{ opacity: 0; }
        .page-checkbox input[type=checkbox]:checked+label:after{
            background-color: #a30d9e;
            opacity: 1;
        }
        @media only screen and (max-width:767px){
            .page-checkbox{ margin: 0 0 20px; }
        }
        .checkbox{
            margin: 0;
            display: inline-block;
            position: absolute;
            top: -17px;
        }
        .checkbox input[type=checkbox]{
            margin: 0;
            visibility: hidden;
            left: 1px;
            top: 1px;
        }
        .checkbox label{
            background: #bbb;
            width: 36px;
            height: 14px;
            min-height: auto;
            padding: 0;
            cursor: pointer;
            border-radius: 50px;
            display: block;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease 0s;
        }
        .checkbox label:before{
            content: '';
            background: #fff;
            width: 20px;
            height: 20px;
            border-radius: 40px;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2),
                        0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 0 0 16px rgba(0, 108, 181, 0);
            transform: translateY(-50%);
            position: absolute;
            top: 50%;
            left: -2px;
            transition: all 0.26s ease 0s;
        }
        /* .checkbox label:active:before{
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2),
                        0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 0 0 16px rgba(255,20,231, 0.6);
        } */
        .checkbox input[type=checkbox]:checked+label{
            background: #e8ebf1;
            transition: all 0.25s ease 0s;
        }
        .checkbox input[type=checkbox]:checked+label:before{
            background: #0abb75;
            left: 18px;
        }
        .error {
            color: red;
        }
        @media only screen and (max-width:767px){
            .checkbox{ margin: 0 0 20px; }
        }
  </style>
</head>
<body>
  <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#">
            @php $siteInfo = site_settings();  @endphp
            @if($siteInfo->com_logo != '')
              <img src="{{asset('public/site-img/'.$siteInfo->com_logo)}}" alt="{{$siteInfo->com_name}}">
            @else
              <h5>{{$siteInfo->com_name}}</h5>
            @endif
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <!-- <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div> -->
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{asset('public/user/default.png')}}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{session()->get('admin_name')}}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{url('admin/profile-settings')}}">
                  <i class="mdi mdi-cached me-2 text-success"></i> My Profile </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item admin-logout" href="javascript:void(0)">
                  <i class="mdi mdi-logout me-2 text-primary"></i>Logout</a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li> 
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
             <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li> -->
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
     
         
      