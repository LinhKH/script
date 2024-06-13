@extends('admin.layout')
@section('title','Edit User')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','User'=>'admin/users']])
        @slot('title') Edit User @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit User @endslot
    @endcomponent
        <form class="form-sample" id="editUser" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($user)
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">User Name</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="url" value="{{url('admin/users/'.$user->id)}}">
                                        <input type="text" class="form-control form-control-sm" name="username" value="{{$user->username}}" placeholder="Enter your User Name" aria-label="User Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control form-control-sm" name="email" value="{{$user->email}}" placeholder="Enter your User Email" aria-label="Email" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone Number</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control form-control-sm" name="phone" value="{{$user->phone}}" placeholder="Enter your User Phone" aria-label="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="country" value="{{$user->country}}" placeholder="Enter your User Country" aria-label="Country">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="state" value="{{$user->state}}" placeholder="Enter your User State" aria-label="State">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="city" value="{{$user->city}}" placeholder="Enter your User City" aria-label="City">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status Name">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1" {{($user->status == "1" ? "selected":"") }}>Active</option>
                                            <option value="0" {{($user->status == "0" ? "selected":"") }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-gradient-primary">Update</button>
            </div>
            @endif
        </form>
        </div>
        </div>
    </div>
</div>
@stop
