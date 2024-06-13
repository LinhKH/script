@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active') Payment Success @endslot
@endcomponent
<!-- Page Header Start -->
<div class="page-header py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Payment Successfull</h2>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div id="site-content">
    <div class="container">
        <div class="row">
            <div class="offset-md-4 col-md-4 text-center">
                <div class="alert alert-success text-center" role="alert">
                    <h4><i class="fas fa-check-circle"></i> Payment Successfull!</h4>
                </div>
                <a href="{{url('/my_booking')}}" class="btn">Go to Bookings</a>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')