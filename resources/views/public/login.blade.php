@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active')Login @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Login @endslot
@endcomponent
<div id="site-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form class="form-horizontal position-relative" id="user-login" method="POST">
                    <h3 class="mb-3">Welcome Back</h3>
                    @csrf
                    <div class="message"></div>
                    <div class="mb-1">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="d-flex flex-row justify-content-between mb-4">
                        <!-- <input type="submit" class="btn" value="Login"> -->
                        <button type="submit" class="btn" value="Login">Login</button>
                        <a href="{{url('forgot-password')}}" class="forgot align-self-center">Forgot Password?</a>
                    </div>
                    <span class="create-new">Don't have an account?  <a href="{{url('signup')}}">Signup</a></span>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')