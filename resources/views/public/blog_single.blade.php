@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/','Blogs'=>'blogs',$blog->blog_category->title=>"blogs/c/".$blog->blog_category->title_slug]])
    @slot('active') {{$blog->title}} @endslot
@endcomponent
<!-- Page Header Start -->
<div class="page-header singlePage-header mb-0 py-5" @if($blog->blog_category->banner_img != '') style="background-image: url('../../public/b-category/{{$blog->blog_category->banner_img}}'); height: 144px;"> @endif
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- <h2>{{$blog->title}}</h2> --}}
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="content-box single-post">
                    <div class="list-grid d-flex flex-column h-100">
                        <h3>{{$blog->title}}</h3>
                        <div class="d-flex justify-content-between mb-2">
                            <span><a href="{{url('blogs/c/'.$blog->blog_category->title_slug)}}"><i class="fas fa-paper-plane"></i> {{$blog->blog_category->title}}</a></span>
                            <span><i class="fas fa-user"></i> {{$blog->author}}</span>
                            <span><i class="fas fa-calendar-alt"></i> {{date('d M, Y',strtotime($blog->created_at))}}</span>
                        </div>
                        <div class="list-image">
                            @if($blog->image != '') 
                                <img src="{{asset('public/blog/'.$blog->image)}}" alt="{{$blog->title}}" />
                            @else
                                <img src="{{asset('public/blog/default.png')}}" alt="{{$blog->title}}" />
                            @endif
                        </div>
                        <div class="list-content px-0">
                            <div class="inner-content">
                                <h3>Description</h3>
                                <p class="description">{!!$blog->description!!}</p>
                            </div>
                        </div>
                        <div class="blog-comment">
                            @if($commentCount > 0)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="mb-3">Comments({{$commentCount}})</h3>
                                        @php  $comments = blog_comments($blog->id);   @endphp
                                        @include('public.partials.commentsDisplay',['comments'=>$comments,'blog_id'=>$blog->id])
                                    </div>
                                </div>
                            @endif
                            @if(session('id'))
                            <form class="pt-3" id="addComment" method="POST">
                                <div class="message"></div>
                                <h4 class="sub-heading">Add Comment</h4>
                                <input type="hidden" class="comment-blog" value="{{$blog->id}}"> 
                                <input type="hidden" class="comment-parent" value="0"/>
                                <textarea class="form-control comment-body mb-3"></textarea>
                                <button type="submit" class="btn">Post Comment</button>
                            </form>
                            @else
                            <a href="{{url('login')}}" class="btn">Comment</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-group mb-5">
                    <li class="list-group-item"><h5>Categories</h5></li>
                    @foreach($category as $item)
                    @if($item->blogs_count > 0)
                    <li class="list-group-item"><a href="{{url('blogs/c/'.$item->title_slug)}}">{{$item->title}}</a></li>
                    @endif
                    @endforeach
                </ul>   
                <div class="sidebar">
                    <h5 class="mb-3">Recent Blogs</h5>
                    @foreach($latest as $item)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if($item->image != '')
                                <img class="img-fluid rounded-start" src="{{asset('public/blog/'.$item->image)}}" alt="{{$item->title}}">
                                @else
                                <img  class="img-fluid rounded-start" src="{{asset('public/blog/default.png')}}" alt="{{$item->title}}">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <small class="text-muted"><a href="{{url('blogs/c/'.$item->blog_category->title_slug)}}">{{$item->blog_category->title}}</a></small>
                                    <h6><a href="{{url('blogs/'.$item->blog_category->title_slug.'/'.$item->title_slug)}}">{{$item->title}}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>        
</div>
@include('public/layout/footer')