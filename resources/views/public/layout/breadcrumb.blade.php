<div id="breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @foreach($breadcrumb as $key => $value)
                <li class="breadcrumb-item"><a href="{{url($value)}}">{{$key}}</a></li>
                @endforeach
                <li class="breadcrumb-item active">{{$active}}</li>
            </ol>
        </nav>
    </div>
</div>