@extends('admin.layout')
@section('title','Add New Blog')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Blog'=>'admin/blogs']])
        @slot('title') Add Blog @endslot
        @slot('add_btn')  @endslot
        @slot('active') Add Blog @endslot
    @endcomponent
        <form class="form-sample" id="addBlog" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Blog Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Blog Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" name="title" placeholder="Enter your Blog Name" aria-label="Blog Name">
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
                                                    <option value="{{$types->id}}">{{$types->title}}</option>
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
                                        <input type="text" class="form-control form-control-sm" name="author" placeholder="Enter your Author Name" aria-label="Author">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea type="text" class="form-control" rows="5" name="des"></textarea>
                                </div>  
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Banner Logo</label>
                                    <!-- <input type="file" class="file-upload-default" name="image" onChange="readURL(this);"> -->
                                    <div class="input-group col-xs-12">
                                        <input type="file" class="form-control form-control-sm file-upload-info" name="img" placeholder="Upload Image" onChange="readURL(this);" style="line-height: 25px;">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-2 text-center">
                                <img id="image" src="{{asset('public/blog/default.png')}}" width="100px" height="100px">
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

