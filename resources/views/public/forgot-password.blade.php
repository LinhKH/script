@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active') Forgot Password @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Forgot Password @endslot
@endcomponent
<div id="site-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form class="form-horizontal position-relative" id="user-forgotPassword" method="POST">
                    <h3>Enter your email</h3>
                    @csrf
                    <div class="message"></div>
                    <div class="mb-3">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <input type="submit" class="btn btn-block" value="Submit">
                        <span class="create-new"><a href="{{url('login')}}">Back to Login</a></span>
                    </div>
                    
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
                @if(Session::has('loginError'))
                    <div class="alert alert-danger">
                        {{Session::get('loginError')}}
                    </div>
                @endif
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>    
@include('public/layout/footer')