@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active')SignUp @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Signup @endslot
@endcomponent
<div id="site-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form class="form-horizontal position-relative" id="user-signup" method="POST">
                    <h3>Create an Account</h3>
                    @csrf 
                    <div class="message"></div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">Your Name</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">Country</label>
                            <input type="text" class="form-control" name="country">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">Phone Number</label>
                            <input type="number" class="form-control" name="phone">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="col-form-label">Email Address</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="col-form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn" value="Signup">Signup</button>
                    </div>
                    <span class="create-new">Already have an account? <a href="{{url('login')}}">Login</a></span>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')