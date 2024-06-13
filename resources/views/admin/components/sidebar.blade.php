<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <!-- <img src="assets/images/faces/face1.jpg" alt="image" class="profile"> -->
                        <img src="{{asset('public/user/default.png')}}" alt="image" class="profile">
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">{{session()->get('admin_name')}}</span>
                        <!-- <span class="text-secondary text-small">Project Manager</span> -->
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/dashboard')}}" class="nav-link {{(Request::path() == 'admin/dashboard')? 'active':''}}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a  href="{{url('admin/categories')}}" class="nav-link {{(Request::path() == 'admin/categories')? 'active':''}}">
                    <span class="menu-title">Category</span>
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a  href="{{url('admin/location')}}" class="nav-link {{(Request::path() == 'admin/location')? 'active':''}}">
                    <span class="menu-title">Locations</span>
                    <i class="mdi mdi-map-marker menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(Request::path() == 'admin/plans' || Request::path() == 'admin/booking')? 'menu-open':''}}" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">Tour Plan</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/plans')? 'active':''}}" href="{{url('admin/plans')}}">Plans</a></li>
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/booking')? 'active':''}}" href="{{url('admin/booking')}}">Booking Log</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(Request::path() == 'admin/blogs' || Request::path() == 'admin/b-categories' || Request::path() == 'admin/comment')? 'menu-open':''}}" data-bs-toggle="collapse" href="#blog-page" aria-expanded="false" aria-controls="blog-page">
                    <span class="menu-title">Blog</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                </a>
                <div class="collapse" id="blog-page">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/blogs')? 'active':''}}" href="{{url('admin/blogs')}}">Blogs</a></li>
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/b-categories')? 'active':''}}" href="{{url('admin/b-categories')}}">Category</a></li>
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/comment')? 'active':''}}" href="{{url('admin/comment')}}">Comments</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/rating')}}" class="nav-link {{(Request::path() == 'admin/rating')? 'active':''}}">
                <span class="menu-title">Rating</span>
                <i class="mdi mdi-star menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/users')}}" class="nav-link {{(Request::path() == 'admin/users')? 'active':''}}">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/pages')}}" class="nav-link {{(Request::path() == 'admin/pages')? 'active':''}}">
                <span class="menu-title">Pages</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/social-settings')}}" class="nav-link {{(Request::path() == 'admin/social-settings')? 'active':''}}">
                <span class="menu-title">Social Setting</span>
                <i class="mdi mdi-wrench menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(Request::path() == 'admin/general-settings' || Request::path() == 'admin/profile-settings'|| Request::path() == 'admin/banner-settings')? 'menu-open':''}}" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-wrench menu-icon"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/general-settings')? 'active':''}}" href="{{url('admin/general-settings')}}">General Setting</a></li>
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/profile-settings')? 'active':''}}" href="{{url('admin/profile-settings')}}">Profile Setting </a></li>
                        <li class="nav-item"> <a class="nav-link {{(Request::path() == 'admin/banner-settings')? 'active':''}}" href="{{url('admin/banner-settings')}}">Banner Setting </a></li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item sidebar-actions">
                <span class="nav-link">
                <div class="border-bottom">
                    <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>
                <div class="mt-4">
                    <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                    </div>
                    <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                    </ul>
                </div>
                </span>
            </li> -->
        </ul>
    </nav>
    <!-- partial -->