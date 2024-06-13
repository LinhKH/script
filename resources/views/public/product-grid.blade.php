<div class="product-grid h-100">
    <div class="product-image">
        @php $gallery = array_filter(explode(',',$item->gallery)); @endphp
        <a href="#" class="image">
            <img class="pic-1" src="{{asset('public/plan/'.$gallery[0])}}" />
        </a>
    </div>
    <div class="product-content">
        <span class="category"><a href="{{url('plan?cat='.$item->slug)}}"><i class="fas fa-paper-plane"></i> {{$item->category}}</a></span>
        <h3 class="title"><a href="{{url('/plan/'.$item->title_slug)}}">{{$item->title}}</a></h3>
        @php $reviews =user_review_count($item->id); @endphp
        @if($reviews->planCount > 0)
            @php  $reviewCount = ceil($reviews->rating/$reviews->planCount); @endphp
        @else
            @php $reviewCount = 0; @endphp
        @endif
        <ul class="rating">
            @for($i=1;$i<=5;$i++)
            <li class="fa fa-star @if($i <= $reviewCount) active @endif"></li>
            @endfor
        </ul>
        <div class="price">${{$item->price}}</div>
    </div>
</div>