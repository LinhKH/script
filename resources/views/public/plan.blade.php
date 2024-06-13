@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active')Search @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Search Tour @endslot
@endcomponent
<div id="site-content">
    <div class="container">
        <form class="row" action="#" id="filter-form">
            <div class="col-md-3">
                <!-- <form action=""> -->
                    <div class="filter">
                        <div class="filter-header">
                            <h4 class="title">Filter</h4>
                        </div>
                        <div class="filter-item">
                            <h5 class="title">Select Dates</h5>
                            <input type="date" class="form-control mb-2 dateCss" name="start_date" value="@if(request()->get('start_date') !== null){{request()->get('start_date')}}@endif" onChange="form.submit()">
                            <input type="date" class="form-control dateCss" name="end_date" value="@if(request()->get('end_date') !== null){{request()->get('end_date')}}@endif" onChange="form.submit()">
                        </div>
                        @if($category)
                            <div class="filter-item">
                                <h5 class="title">Categories</h5>
                                <ul>
                                    <li>
                                        <input type="checkbox" class="category_name all-category" id="all" {{(request()->get('cat') === null) ? 'checked' : ''}}>
                                        <label for="all"> All Categories</label>
                                    </li>
                                    @foreach($category as $row)
                                    <li>
                                        @php 
                                            $select_category = '';
                                            if(request()->get('cat') && request()->get('cat') != ''){
                                                if(is_array(request()->get('cat'))){
                                                $select_category = (in_array($row->title_slug,request()->get('cat'))) ? 'checked' : '';
                                                }else{
                                                $select_category = ($row->title_slug == request()->get('cat')) ? 'checked' : '';
                                                }
                                            }                                        
                                        @endphp
                                        @if($row->plans_count > 0)
                                        <input type="checkbox" class="category_name" id="checkbox{{ $row->title_slug }}" name="cat[]" value="{{ $row->title_slug}}" {{ $select_category }}  onchange="form.submit()">
                                        <label for="checkbox{{$row->title_slug}}"> {{ $row->title }}</label>
                                        @endif
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($location)
                        <div class="filter-item">
                            <h5 class="title">Locations</h5>
                            <ul>
                                <li class="radio-button">
                                    <input type="radio" class="location_name all-location" id="all-loc" {{(request()->get('location') === null) ? 'checked' : ''}}>
                                    <label for="all-loc"> All Locations</label>
                                </li>
                                @foreach($location as $row)
                                    @if($row->plan_count > 0)
                                    <li class="radio-button">
                                        @php 
                                            $select_location = '';
                                            if(request()->get('location') && request()->get('location') != ''){
                                                $select_location = ($row->location_slug == request()->get('location')) ? 'checked' : '';
                                            }                                        
                                        @endphp
                                        <input type="radio" class="location_name" id="radio{{ $row->location_slug }}" name="location" value="{{ $row->location_slug}}" {{ $select_location }}  onchange="form.submit()">
                                        <label for="radio{{$row->location_slug}}"> {{ $row->location }}</label>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="filter-item">
                            <h5 class="title">Price</h5>
                            <div id="slider-range" class="price-filter-range" name="rangeInput" style="display:none;" ></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="d-block price_number">Min</span>
                                    @php 
                                        $min_price = 0;
                                        if(request()->get('min_price') && request()->get('min_price') != ''){
                                            $min_price = request()->get('min_price');
                                        }                                        
                                    @endphp
                                    <input type="number" name="min_price" min=0 max="100000000" oninput="validity.valid||(value='0');" class="price-range-field" value="{{$min_price}}" />
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block price_number">Max</span>
                                    @php 
                                        $max_price = 100000000;
                                        if(request()->get('max_price') && request()->get('max_price') != ''){
                                            $max_price = request()->get('max_price');
                                        }    
                                    @endphp
                                    <input type="number" name="max_price" min=0 max=100000000 class="price-range-field" value="{{$max_price}}" />
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-sm mt-2" onclick="form.submit()">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="col-md-9">
                <div class="content-box d-flex flex-row justify-content-between align-items-center">
                    <h5 class="title">{{$plan->total()}} Tours Found</h5>
                    <div class="d-flex flex-row">
                        <label for="" class="text-nowrap my-auto mr-2">Sort By</label>
                        @php $sort = ''; @endphp
                        @if(request()->sort && request()->sort != '')
                        @php $sort = request()->sort; @endphp
                        @endif
                        <select class="form-select form-control" name="sort" onChange="form.submit()">
                            <option value="latest" {{(($sort == 'latest') ? 'selected' : '')}}>Latest</option>
                            <option value="oldest" {{(($sort == 'oldest') ? 'selected' : '')}}>Oldest</option>
                            <option value="l-h" {{(($sort == 'l-h') ? 'selected' : '')}}>Price:Low to High</option>
                            <option value="h-l" {{(($sort == 'h-l') ? 'selected' : '')}}>Price:High to Low</option>
                        </select>
                    </div>
                </div>
                <div class="row search-res-list">
                    @if(!empty($plan) && $plan->isNotEmpty())
                        @foreach($plan as $item)
                        <div class="col-md-4 mb-4">
                            @include('public.product-grid',$item)
                        </div>
                        @endforeach
                        <div class="col-12">
                            {!!$plan->links() !!}
                        </div>
                    @else
                        <div class="col-12 text-center">
                            <h3 class="sub-heading">No Plans Found</h3>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@include('public/layout/footer')