@include('public/layout/header')
@component('public.layout.breadcrumb', ['breadcrumb' => ['Home' => '/']])
    @slot('active')
        Checkout Page
    @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title')
        Checkout
    @endslot
@endcomponent
<div id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="content-box single-post">
                    <div class="list-grid d-flex flex-column h-100">
                        <h3>{{ $plan->title }}</h3>
                        <div class="list-image">
                            @php $gallery = array_filter(explode(',',$plan->gallery)); @endphp
                            @if (empty($gallery))
                                <img src="{{ asset('public/plan/default.png') }}" alt="">
                            @else
                                <img src="{{ asset('public/plan/' . $gallery[0]) }}" />
                            @endif
                        </div>
                        <div class="list-content px-0">
                            <div class="inner-content">
                                <h3>Description</h3>
                                <p class="description">{!! $plan->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="table-active">Plans Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Plan Name</th>
                            <td>{{ $plan->title }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $plan->category }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ $plan->locationName->location }}</td>
                        </tr>
                        <tr>
                            <th>Duration</th>
                            <td>{{ $plan->duration }}</td>
                        </tr>
                        <tr>
                            <th>Dates</th>
                            <td>{{ $plan->start_time }} - {{ $plan->end_time }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ site_settings()->cur_format }}{{ $plan->price }}</td>
                        </tr>
                        <tr>
                            <th>Seats</th>
                            <td>{{ request()->get('qty') }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{ site_settings()->cur_format }}{{ request()->get('qty') * $plan->price }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <form action="{{ url('plan/' . $plan->title_slug . '/checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" name="plan_id"
                                        value="{{ $plan->id }}">
                                    <input type="hidden" class="form-control" name="pay_method" value="stripe">
                                    <input type="hidden" class="form-control" name="user_id"
                                        value="{{ session('id') }}">
                                    <input type="hidden" class="form-control" name="pay_id" value="1">
                                    <input type="hidden" class="form-control" name="seats"
                                        value="{{ Request::get('qty') }}">
                                    <input type="hidden" class="form-control" name="amount"
                                        value="{{ $plan->price }}">
                                    <input type="hidden" class="form-control" name="grand_total"
                                        value="{{ Request::get('qty') * $plan->price * 100 }}">
                                    <button type="submit" class="btn">Booking</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')
