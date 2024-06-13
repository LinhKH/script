@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active')My Booking @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') My Bookings @endslot
@endcomponent
<div id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($booking->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Plan Name</th>
                            <th>Location</th>
                            <th>Duration</th>
                            <th>Persons</th>
                            <th>Booked On</th>
                        </tr>
                    </thead>
                    @foreach($booking as $item)
                    <tbody>
                        <tr>
                            <td><a href="{{url('plan/'.$item->plan->title_slug)}}">{{$item->plan->title}}</a>
                            <span class="d-block">Price : {{site_settings()->cur_format}}{{$item->plan->price}}</span></td>
                            <td>{{$item->plan->locationName->location}}</td>
                            <td>{{date('D d M, Y',strtotime($item->plan->start_time))}} to {{date('D d M, Y',strtotime($item->plan->end_time))}}
                            <small class="d-block">({{$item->plan->duration}})</small></td>
                            <td>{{$item->seats}}</td>
                            <td>{{date('D d M, Y',strtotime($item->created_at))}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @else
                <div class="text-center">
                    <h3 class="mb-3">No Bookings Found</h3>
                    <a href="{{url('plan')}}" class="btn">Explore Plans</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')