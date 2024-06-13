@extends('admin.layout')
@section('title','Profile Settings')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Profile Settings @endslot
        @slot('add_btn')  @endslot
        @slot('active') Profile Settings @endslot
    @endcomponent
    <div class="col-12 mb-5">
        @foreach($data as $item)
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Admin Details</h4>
                <form class="forms-sample" id="updateProfileSetting" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Admin Name</label>
                        <input type="text" class="form-control form-control-sm" name="admin_name" value="{{$item->admin_name}}" placeholder="Enter Admin Name">
                    </div>
                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" class="form-control form-control-sm" name="admin_email" value="{{$item->admin_email}}" placeholder="Enter Admin Email">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control form-control-sm" name="username"  value="{{$item->username}}" placeholder="Enter Username">
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Change Password</h4>
                <form class="forms-sample" id="updatePassword" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" class="form-control form-control-sm" name="password" placeholder="Enter Current Password">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="new" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control form-control-sm" name="new_confirm" placeholder="Enter Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary me-2">Update</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    </div>
    </div>
</div>
</div>
@stop