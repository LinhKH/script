@extends('admin.layout')
@section('title','Pages')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Page'=>'admin/pages']])
        @slot('title') Pages @endslot
        @slot('add_btn')  @endslot
        @slot('active') Pages @endslot
    @endcomponent
    <div class="col-12 mb-5">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Page Details</h4>
                <form class="forms-sample" id="addPage" method="POST">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" class="form-control form-control-sm" name="title" placeholder="Enter Page Title">
                    </div>
                    <div class="form-group">
                        <label>Page Description</label>
                        <textarea class="form-control form-control-sm" name="des" rows="5" placeholder="Place some text here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
</div>
@stop