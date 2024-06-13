<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $siteInfo = site_settings(); @endphp
    <title>@yield('title'){{$siteInfo->com_name}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/bootstrap5.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/flexslider.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('public/assets/public/css/style.css')}}">
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <ul class="top-address">
                                @php $social = social_links(); @endphp
                                @foreach($social as $item)
                                    <li><a href="{{$item->url}}" target="_blank"><i class="{{$item->icon}}"></i></a></li>
                                @endforeach
                                <li>{{$siteInfo->com_email}}</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="header-user-menu text-end">
                                @if(session()->has('username'))
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user"></i> Hello, {{session()->get('username')}}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{url('profile')}}">Profile</a>
                                            <a class="dropdown-item" href="{{url('my_booking')}}">My Booking</a>
                                            <a class="dropdown-item" href="{{url('change-password')}}">Change Password</a>
                                            <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                                        </div>
                                    </li>
                                @else
                                    <li><a href="{{url('login')}}">Login</a></li>
                                    <li><a href="{{url('signup')}}">Signup</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="{{url('/')}}">
                        @if(empty($siteInfo->com_logo == ''))
                        <img src="{{asset('public/site-img/'.$siteInfo->com_logo)}}">
                        @else
                        {{$siteInfo->com_name}}
                        @endif
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{url('/')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('plan*') ? 'active' : '' }}" href="{{url('plan')}}">Plans</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('blogs*') ? 'active' : '' }}" href="{{url('blogs')}}">Blog</a>
                            </li>
                            @php $pages = site_pages(); @endphp
                            @if($pages->isNotEmpty())
                                @foreach($pages as $page)
                                    @if($page->show_in_header == '1')
                                    <li class="nav-item"><a class="nav-link" href="{{url($page->page_slug)}}">{{$page->page_title}}</a></li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{url('contact')}}">Contact</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sign.html">Sign</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
       