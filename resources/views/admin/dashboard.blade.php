@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2"><i class="mdi mdi-home"></i></span>
                    Dashboard
                </h3>
            </div>
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('public/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3"> <a href="{{ url('admin/users') }}" class="text-decoration-none text-white">Total User</a>  <i
                                    class="mdi mdi-chart-line mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $user }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('public/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3"><a href="{{ url('admin/plans') }}" class="text-decoration-none text-white">Tour Plan</a> <i
                                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $plan }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('public/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3"><a href="{{ url('admin/booking') }}" class="text-decoration-none text-white">Booking</a> <i class="mdi mdi-diamond mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $booking }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Latest Blog Comment</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Plan Name </th>
                                            <th>Comment </th>
                                        </tr>
                                    </thead>
                                    @php $i=0; @endphp
                                    <tbody>
                                        @if ($comment->isNotEmpty())
                                            @foreach ($comment as $item)
                                                @php  $i++; @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->user }}</td>
                                                    <td>{{ $item->blog }}</td>
                                                    <td>{{ $item->comment }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" align="center">No Comments Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Latest Plan Review Rating</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Plan Name</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    @php $i=0; @endphp
                                    <tbody>
                                        @if ($reviewRating->isNotEmpty())
                                            @foreach ($reviewRating as $item)
                                                @php $i++; @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $item->user }}</td>
                                                    <td>{{ $item->plan }}</td>
                                                    <td>{{ $item->star_rating }}</td>
                                                    <td>{{ $item->comment }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" align="center">No Reviews Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @stop
