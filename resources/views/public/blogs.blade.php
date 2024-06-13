@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active') Blogs @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') Blogs @endslot
@endcomponent
<div id="site-content">
    <div class="container">
        <div class="row">
            @if($blog->isNotEmpty())
            @foreach($blog as $item)
            <div class="col-md-4 mb-5">
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
@include('public/layout/footer')