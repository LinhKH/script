@extends('admin.layout')
@section('title','Edit Blog')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Blog'=>'admin/blogs']])
        @slot('title') Edit Blog @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Blog @endslot
    @endcomponent
        <form class="form-sample" id="updateBlog" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($blog)
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Blog Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Blog Name</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="url" value="{{url('admin/blogs/'.$blog->id)}}">
                                        <input type="text" class="form-control form-control-sm" name="title" value="{{$blog->title}}" placeholder="Enter your Blog Name" aria-label="Blog">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Blog Slug</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="slug" value="{{$blog->title_slug}}" placeholder="Enter your Blog Title Slug" aria-label="Blog">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="category" placeholder="Enter your Category Name">
                                            @if(!empty($category))
                                                @foreach($category as $types)
                                                    @if($blog->category == $types->id)
                                                    <option value="{{$types->id}}" selected>{{$types->title}}</option>
                                                    @else
                                                    <option value="{{$types->id}}">{{$types->title}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Author</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="author" value="{{$blog->author}}" placeholder="Enter your Author Name" aria-label="Author">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status Name">
                                            <option value="" selected disabled>Select Status</option>    
                                            <option value="1"  {{($blog->status == "1" ? "selected":"") }}>Active</option>
                                            <option value="0"  {{($blog->status == "0" ? "selected":"") }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" class="form-control" rows="5" name="des">{!!htmlspecialchars_decode($blog->description)!!}</textarea>
                                </div>  
                            </div>  
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>File upload</label>
                                    <!-- <input type="file" name="img[]" class="file-upload-default"> -->
                                    <div class="input-group col-xs-12">
                                        <input type="hidden" class="form-control form-control-sm file-upload-info" name="old_img" value="{{$blog->image}}" />
                                        <input type="file" class="form-control form-control-sm file-upload-info"  placeholder="Upload Image"  name="img" onChange="readURL(this);" style="line-height: 25px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                @if($blog->image != '')
                                    <img id="image" src="{{asset('blog/'.$blog->image)}}" alt="" width="100px" height="80px">
                                @else
                                    <img id="image" src="{{asset('blog/default.png')}}" alt="" width="100px" height="80px">
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
