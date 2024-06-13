@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active'){{$page_detail->page_slug}} @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') {{$page_detail->page_title}} @endslot
@endcomponent
<div id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>{!!htmlspecialchars_decode($page_detail->description)!!}</p>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')