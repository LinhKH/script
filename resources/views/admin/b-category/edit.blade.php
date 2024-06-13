@extends('admin.layout')
@section('title','Edit Blog Category')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Blog Category'=>'admin/b-category']])
        @slot('title') Edit Blog Category @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Blog Category @endslot
    @endcomponent
    <form class="forms-sample" id="updateBlogCat" method="POST">
        @csrf
        {{method_field('PUT')}}
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Blog Category Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Title</label>
                                    <input type="text" hidden class="url" value="{{url('admin/b-category/'.$category->id)}}">
                                    <input type="text" class="form-control form-control-sm" name="title" value="{{$category->title}}" placeholder="Enter Blog Category Title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Slug</label>
                                    <input type="text" class="form-control form-control-sm" name="slug" value="{{$category->title_slug}}" placeholder="Enter Blog Category Slug">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm" name="status" placeholder="Enter your Status">
                                        <option value="1" {{$category->status == '1' ? "selected":""}}>Active</option>
                                        <option value="0" {{$category->status == '0' ? "selected":""}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Category Banner Image</label>
                                    <div class="input-group col-xs-12">
                                        <input type="hidden" class="form-control form-control-sm file-upload-info" name="old_img" value="{{$category->banner_img}}" />
                                        <input type="file" class="form-control form-control-sm file-upload-info"  placeholder="Upload Image"  name="img" onChange="readURL(this);" style="line-height: 25px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                @if($category->banner_img != '')
                                    <img id="image" src="{{asset('public/b-category/'.$category->banner_img)}}" alt="" width="100px" height="80px">
                                @else
                                    <img id="image" src="{{asset('public/b-category/default.jpg')}}" alt="" width="100px" height="80px">
                                @endif
                            </div> 
                            <div class="col-12">     
                                <button type="submit" class="btn btn-sm btn-gradient-primary me-2">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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