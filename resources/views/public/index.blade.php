@include('public/layout/header')
<!-- Banner Start -->
<div id="banner" style="background-image: url('{{asset('/public/banner/'.$banner->image)}}')">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <h1>{{$banner->title}}</h1>
                <h3>{{$banner->sub_title}}</h3>
                <form action="{{url('/plan/')}}" class="search-form row b-search">
                    <!-- @csrf -->
                    <div class="col-md-3 position-relative">
                        <select class="form-select form-control"name="location" id="location">
                            <option value="" disabled selected>Select Location</option>
                            @if(!empty($location))
                                @foreach($location as $types)
                                    @if($types->plan_count > 0)
                                        <option value="{{$types->location_slug}}">{{$types->location}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control">
                    </div>
                    <div class="col-md-3 d-grid">
                        <input type="submit" class="btn btn-primary" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->
@if($plan->isNotEmpty())
    <div class="trending-section py-5">
        <div class="container-xl container-fluid">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h2 class="section-head">Trending <span>Tours</span></h2>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel trending-carousel owl-theme position-relative">
                        @if(!empty($plan))
                            @foreach($plan as $item)
                                {{-- @if($item->count > 0) --}}
                                    @include('public.product-grid',$item)
                                {{-- @endif --}}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($destination->isNotEmpty())
    <div class="destinations-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h2 class="section-head">Top <span>Destinations</span></h2>
                </div>
                @if(!empty($destination))
                    @foreach($destination as $item)
                        {{-- @if($item->count > 0) --}}
                        <div class="col-md-4">
                            <a href="{{url('plan?location='.$item->location_slug)}}" class="destination">
                                @if($item->image != '') 
                                <img class="img-fluid" src="{{asset('public/location/'.$item->image)}}" alt="{{$item->location}}" />
                                @else
                                <img class="img-fluid" src="{{asset('public/location/default.jpg')}}" alt="{{$item->location}}" />
                                @endif
                                <div class="destination-content">
                                    <h4>{{$item->location}}</h4>
                                </div>
                            </a>
                        </div>
                        {{-- @endif --}}
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @endif
    @if($blog->isNotEmpty())
    <div class="blogs-section py-5">
        <div class="container-xl container-fluid">
            <div class="row">
                <div class="col-md-12 d-flex flex-row justify-content-between mb-4">
                    <h2 class="section-head">Recent <span>Articles</span></h2>
                    <a href="{{url('/blogs')}}" class="btn align-self-center">Show All</a>
                </div>
                @foreach($blog as $item)
                <div class="col-md-4 mb-5">
                    @include('public.partials.blog-grid')
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@include('public/layout/footer')
    
     