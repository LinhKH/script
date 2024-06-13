@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active')Reset Password @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Reset Password @endslot
@endcomponent
<div id="site-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form class="form-horizontal position-relative" id="user-resetPassword" method="POST">
                    <h3>Enter New Password</h3>
                    @csrf
                    <div class="message"></div>
                    <div class="mb-1 row">
                        <label class="col-form-label">New Password</label>
                        <input type="hidden" name="id"  class="url" value="{{$user[0]['id']}}">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="mb-2 row">
                        <label class="col-form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password">
                    </div>
                    <input type="submit" class="btn btn-block" value="Reset Password">
                </form>
            </div>
        </div>
        <div class="row">
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
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>
@include('public/layout/footer')