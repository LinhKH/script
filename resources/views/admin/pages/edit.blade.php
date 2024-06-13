@extends('admin.layout')
@section('title','Edit Pages')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Page'=>'admin/pages']])
        @slot('title') Edit Pages @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Pages @endslot
    @endcomponent
    <div class="col-12 mb-5">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Page Details</h4>
                <form class="forms-sample" id="updatePage" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" hidden class="url" value="{{url('admin/pages/'.$page->id)}}">
                        <input type="text" class="form-control form-control-sm" name="title" value="{{$page->page_title}}" placeholder="Enter Page Title">
                    </div>
                    <div class="form-group">
                        <label>Page Slug</label>
                        <input type="text" class="form-control form-control-sm" name="slug" value="{{$page->page_slug}}" placeholder="Enter Page Slug">
                    </div>
                    <div class="form-group">
                        <label>Page Description</label>
                        <textarea class="form-control form-control-sm" name="des" rows="5" placeholder="Place some text here">{!!$page->description!!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status">
                            <option value="1" {{$page->status == '1' ? "selected":""}}>Active</option>
                            <option value="0" {{$page->status == '0' ? "selected":""}}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
</div>
@stop