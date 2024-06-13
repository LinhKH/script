<div class="page-header">
    <h3 class="page-title">
        {{ $title }}
        <span class="page-title bg-gradient-primary text-white">{{ $add_btn }}</span>
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumb as $key => $value)
                <li class="breadcrumb-item"><a href="{{ url($value) }}">{{ $key }}</a></li>
            @endforeach
            <li class="breadcrumb-item active">{{ $active }}</li>
        </ol>
    </nav>
</div>
