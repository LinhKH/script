@include('public/layout/header')
@component('public.layout.breadcrumb', [
    'breadcrumb' => ['Home' => '/', $plan->catName->title_slug => 'plan?cat=' . $plan->catName->title_slug],
])
    @slot('active')
        {{ $plan->title }}
    @endslot
@endcomponent
<!-- Page Header Start -->
<div class="page-header singlePage-header mb-0 py-5"
    @if ($plan->catName->banner_img != '') style="background-image: url('../public/category/{{ $plan->catName->banner_img }}'); height: 144px;"> @endif
    <div class="container">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
</div>
</div>
<!-- Page Header End -->
<div id="site-content">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="content-box single-post">
                    <div class="list-grid d-flex flex-column h-100">
                        <h3>{{ $plan->title }}</h3>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-clock"></i> Duration: {{ $plan->duration }}</span>
                            <span><i class="fas fa-users"></i> Group Size: {{ $plan->capacity }}</span>
                            <span><i class="fas fa-map-marker-alt"></i> Location:
                                {{ $plan->locationName->location }}</span>
                            <span><i class="fas fa-calendar-alt"></i>
                                {{ date('d M, Y', strtotime($plan->created_at)) }}</span>
                        </div>
                        <div class="list-image">
                            @php $gallery = array_filter(explode(',',$plan->gallery)); @endphp
                            @if (empty($gallery))
                                <img src="{{ asset('plan/default.png') }}" alt="">
                            @else
                                <div class="flexslider">
                                    <ul class="slides">
                                        @for ($i = 0; $i < count($gallery); $i++)
                                            <li data-thumb="{{ asset('plan/' . $gallery[$i]) }}">
                                                <img src="{{ asset('plan/' . $gallery[$i]) }}" />
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            @endif
                            <!-- <img src="{{ asset('plan/default.jpg') }}" alt=""> -->
                        </div>
                        <div class="list-content px-0">
                            <div class="inner-content">
                                <h3>Description</h3>
                                <p class="description">{!! $plan->description !!}</p>
                            </div>
                            <div class="inner-content">
                                <h3>Included</h3>
                                @php
                                    $includes = [];
                                    if ($plan->includes != '') {
                                        $includes = array_filter(explode(',', $plan->includes));
                                    }
                                @endphp
                                <ul class="list-includes">
                                    @for ($i = 0; $i < count($includes); $i++)
                                        <li><i class="fas fa-check-circle"></i>{{ $includes[$i] }}</li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="inner-content">
                                <h3>Excluded</h3>
                                @php
                                    $excludes = [];
                                    if ($plan->excludes != '') {
                                        $excludes = array_filter(explode(',', $plan->excludes));
                                    }
                                @endphp
                                <ul class="list-excludes">
                                    @for ($i = 0; $i < count($excludes); $i++)
                                        <li><i class="fas fa-check-circle"></i>{{ $excludes[$i] }}</li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="inner-content">
                                @foreach ($plan->tourPlan as $tour)
                                    <h5 class="mb-2">{{ $tour->title }}: {{ $tour->sub_title }}</h5>
                                    <p>{!! $tour->description !!}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <h4 class="sub-heading">Reviews</h4>
                    <div class="comment-widgets">
                        @foreach ($reviewRating as $star)
                            <!-- Comment Row -->
                            <div class="d-flex flex-row comment-row m-t-0">
                                @if ($star->image != '')
                                    <div class="p-2"><img src="{{ asset('user/' . $star->image) }}"
                                            alt="user" width="50" class="rounded-circle"></div>
                                @else
                                    <div class="p-2"><img src="{{ asset('user/default.png') }}"
                                            alt="user" width="50" class="rounded-circle"></div>
                                @endif
                                <div class="comment-text w-100">
                                    <h6 class="font-medium">{{ $star->username }}</h6> <span
                                        class="m-b-0 d-block">{{ $star->comment }}</span>
                                    <div class="rated d-block">
                                        @for ($i = 1; $i <= $star->star_rating; $i++)
                                            <label class="star-rating-complete" title="text">{{ $i }}
                                                stars</label>
                                        @endfor
                                    </div>
                                    <div class="comment-footer text-right"><span
                                            class="text-muted">{{ date('d M, Y', strtotime($star->created_at)) }}</span>
                                    </div>
                                </div>
                            </div> <!-- Comment Row -->
                        @endforeach
                    </div> <!-- Card -->
                    @if (session('id'))
                        <form class="py-2" id="addReview" method="POST" autocomplete="off">
                            @csrf
                            <span>Choose Star Rating</span>
                            <div class="form-group rating-stars">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <input type="hidden" class="form-control" name="user_id" value="{{ session('id') }}">
                                <div class="rate mb-2">
                                    <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2">
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating"
                                        value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <textarea class="form-control h-auto" name="comment" rows="3" placeholder="Comment" maxlength="200"></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn py-2 px-3"> Submit </button>
                            </div>
                            <div class="message mt-2"></div>
                        </form>
                    @else
                        <a href="{{ url('login') }}" class="btn btn-primary link-btn">Login</a>
                    @endif
                </div>
                <div class="content-box single-post">
                    <h3 class="mb-3">You Might Also Like</h3>
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($related) && $related->isNotEmpty())
                                <div class="owl-carousel owl-theme related-carousel">
                                    @foreach ($related as $item)
                                        @include('public.product-grid', $item)
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{ url('plan/' . $plan->title_slug . '/checkout') }}" method="GET">
                    @csrf
                    <div class="content-box sidebar">
                        <div class="price-content price">
                            <h3 class="text-center mb-1">Book the Tour</h3>
                            <h5 class="text-center">Basic Price ${{ $plan->price }}</h5>
                            <input type="hidden" name="user_id" value="{{ session('id') }}">
                        </div>
                        <div class="date d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label><b>Depature Date:</b></label>
                            </div>
                            <div class="value">{{ date('D d M, Y', strtotime($plan->start_time)) }}</div>
                        </div>
                        <div class="date d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label><b>Return Date:</b></label>
                            </div>
                            <div class="value">{{ date('D d M, Y', strtotime($plan->end_time)) }}</div>
                        </div>
                        <div class="date d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <label><b>Capacity:</b></label>
                            </div>
                            <div class="value">{{ $plan->capacity }}</div>
                        </div>
                        @php $available = $plan->capacity - $booked;  @endphp
                        @if ($available > 0)
                            <div class="date d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label><b>Available:</b></label>
                                </div>
                                <div class="value">{{ $plan->capacity - $booked }}</div>
                            </div>
                            <div class="aduit d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label>Persons</label>
                                </div>
                                <input type="number" class="form-control item-qty" min='1'
                                    max="{{ $plan->capacity - $booked }}" name="qty" style="width: 80px;"
                                    value="1">
                                <input type="number" class="plan-price" name="price" value="{{ $plan->price }}"
                                    hidden>
                            </div>
                            <div class="date d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <label><b>Total Amount:</b></label>
                                </div>
                                <div class="total-amount">{{ $plan->price }}</div>
                            </div>
                            <div class="submit-book d-grid gap-2">
                                <button class="btn btn-lg text-uppercase" type="submit">Confirm Plan</button>
                            </div>
                        @else
                            <div class="date text-center">
                                <label><b>All Booked</b></label>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')
