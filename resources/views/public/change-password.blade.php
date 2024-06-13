@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active') Change Password @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Change Password @endslot
@endcomponent
<div id="site-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form class="form-horizontal change-pwd-form position-relative" id="updatePassword" method="POST">
                    @csrf
                    <div class="message"></div>
                    <div class="mb-3">
                        <label>Current Password</label>
                        <input type="password" class="form-control" name="old_password" placeholder="Enter Current Password Here">
                    </div>
                    <div class="mb-3">
                    <label>New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password Here">
                    </div> 
                    <div class="mb-3">
                    <label>Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password Here">
                    </div> 
                    <button type="submit" class="btn">Update</button>
                </form>   
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')