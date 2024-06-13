@extends('admin.layout')
@section('title', 'Add New Category')
@section('content')
    <div class="main-panel">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @component('admin.components.content-header', [
                'breadcrumb' => ['Dashboard' => 'admin/dashboard', 'Category' => 'admin/categories'],
            ])
                @slot('title')
                    Add Category
                @endslot
                @slot('add_btn')
                @endslot
                @slot('active')
                    Add Category
                @endslot
            @endcomponent
            <form class="form-sample" id="addCategory" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Category Details</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="title"
                                                placeholder="Enter your Category Name" aria-label="Category Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Category Banner Image</label>
                                        <div class="input-group col-xs-12">
                                            <input type="file" class="form-control form-control-sm file-upload-info"
                                                name="img" placeholder="Upload Image" onChange="readURL(this);"
                                                style="line-height: 25px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 text-center">
                                    <img id="image" src="{{ asset('category/default.jpg') }}" width="100px"
                                        height="100px">
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
