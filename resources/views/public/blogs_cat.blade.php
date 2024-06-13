@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/','Blogs'=> 'blogs']])
    @slot('active') {{$category->title}} @endslot
@endcomponent
<!-- Page Header Start -->
<div class="page-header singlePage-header py-5" @if($category->banner_img != '') style="background-image: url('../../public/b-category/{{$category->banner_img}}')"> @endif
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{$category->title}}</h2>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div id="site-content">
    <div class="container">
        <div class="row">
            @if($blog->isNotEmpty())
                @foreach($blog as $item)
                <div class="col-md-4">
                    @include('public.partials.blog-grid')
                </div>
                @endforeach
                <div class="col-12">
                    {{$blog->links()}}
                </div>
                @else
                <div class="col-12 text-center">
                    <h3 class="sub-heading">No Blogs Found</h3>
                </div>
            @endif   
        </div>
    </div>
</div>