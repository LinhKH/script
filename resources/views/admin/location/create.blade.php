@extends('admin.layout')
@section('title','Add New Location')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Location'=>'admin/location']])
        @slot('title') Add Location @endslot
        @slot('add_btn')  @endslot
        @slot('active') Add Location @endslot
    @endcomponent
        <form class="form-sample" id="addLocation" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Location Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Location Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="location" placeholder="Enter your Location Name" aria-label="Location Name">
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
                                                    <option value="{{ $types->id }}">{{ $types->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Location Image</label>
                                    <div class="input-group col-xs-12">
                                        <input type="file" class="form-control form-control-sm file-upload-info" name="img" placeholder="Upload Image" onChange="readURL(this);" style="line-height: 25px;">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-2 text-center">
                                <img id="image" src="{{asset('public/location/default.jpg')}}" width="100px" height="100px">
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-gradient-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
    </div>
</div>
@stop
@section('pageJsScripts')
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

