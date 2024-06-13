@extends('admin.layout')
@section('title','Banner Settings')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') Banner Settings @endslot
        @slot('add_btn')  @endslot
        @slot('active') Banner Settings @endslot
    @endcomponent
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="form-sample" id="updateBannerSetting" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @foreach($data as $item)
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Banner Logo</label>
                                <input type="hidden" class="file-upload-default" name="old_image" value="{{$item->image}}" />
                                <!-- <input type="file" class="file-upload-default" name="image" onChange="readURL(this);"> -->
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control form-control-sm file-upload-info" name="image" placeholder="Upload Image" onChange="readURL(this);" style="line-height: 25px;">
                                    <!-- <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span> -->
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            @if(empty($item->image))
                                <img id="image" src="{{asset('banner/default.jpg')}}" width="100px" height="100px">
                            @else
                                <img id="image" src="{{asset('banner/'.$item->image)}}" width="100px" height="100px">
                            @endif
                        </div>  
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" name="title" value="{{$item->title}}" placeholder="Enter your Title Name" aria-label="Banner Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" name="sub_title" value="{{$item->sub_title}}" placeholder="Enter your sub_title  Name" aria-label="Banner Name">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary mb-2">Update</button>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@stop