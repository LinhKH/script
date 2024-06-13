<div class="blog-info h-100">
    <div class="blog-img">
        @if($item->image != '') 
        <img src="{{asset('public/blog/'.$item->image)}}" alt="{{$item->title}}" />
        @else
        <img src="{{asset('public/blog/default.png')}}" alt="{{$item->title}}" />
        @endif
    </div>
    <div class="blog-content">
        <div class="d-flex mb-2">
            <span class="blog-category"><a href="{{url('blogs/c/'.$item->blog_category->title_slug)}}"><i class="fas fa-paper-plane"></i> {{$item->blog_category->title}}</a></span>
            <span class="post-time ms-auto my-auto"><i class="far fa-calendar"></i> {{date('d M, Y',strtotime($item->created_at))}}</span>
        </div>
        <h3><a href="{{url('blogs/'.$item->blog_category->title_slug.'/'.$item->title_slug)}}">{{$item->title}}</a></h3>
        <p>{!!substr(htmlspecialchars_decode($item->description),0,100).'...'!!}</p>
    </div>
</div>