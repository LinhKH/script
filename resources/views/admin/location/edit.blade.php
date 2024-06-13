@extends('admin.layout')
@section('title','Edit Location')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Location'=>'admin/location']])
        @slot('title') Edit Location @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Location @endslot
    @endcomponent
        <form class="form-sample" id="updateLocation" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($location)
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Location Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Location Name</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" class="url" value="{{url('admin/location/'.$location->id)}}">
                                        <input type="text" class="form-control form-control-sm" name="location" value="{{$location->location}}" placeholder="Enter your Location Name" aria-label="Location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Location Slug</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="slug" value="{{$location->location_slug}}" placeholder="Enter your Location Name Slug" aria-label="Location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="category" id="categorySelect"
                                            placeholder="Enter your Category Name">
                                            <option value="" selected disabled>Select Category</option>
                                            @if (!empty($categories))
                                                @foreach ($categories as $types)
                                                    <option value="{{ $types->id }}" {{ $types->id === $location->category_id ? 'selected' : '' }}>{{ $types->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status Name">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1"  {{($location->status == "1" ? "selected":"") }}>Active</option>
                                            <option value="0"  {{($location->status == "0" ? "selected":"") }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>File upload</label>
                                    <!-- <input type="file" name="img[]" class="file-upload-default"> -->
                                    <div class="input-group col-xs-12">
                                        <input type="hidden" class="form-control form-control-sm file-upload-info" name="old_img" value="{{$location->image}}" />
                                        <input type="file" class="form-control form-control-sm file-upload-info"  placeholder="Upload Image"  name="img" onChange="readURL(this);" style="line-height: 25px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                @if($location->image != '')
                                    <img id="image" src="{{asset('public/location/'.$location->image)}}" alt="" width="100px" height="80px">
                                @else
                                    <img id="image" src="{{asset('public/location/default.jpg')}}" alt="" width="100px" height="80px">
                                @endif
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-gradient-primary">Update</button>
            </div>
            @endif
        </form>
    </div>
    </div>
    </div>
</div>
@stop
@section('pageJsScripts')
<script>
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
