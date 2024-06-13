@extends('admin.layout')
@section('title','Social Settings')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Social Setting'=>'admin/social-settings']])
        @slot('title') Social Settings @endslot
        @slot('add_btn')  @endslot
        @slot('active') Social Settings @endslot
    @endcomponent
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Social Setting Details</h4>
                <form class="forms-sample" id="addSocial" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Social Name</label>
                        <input type="text" class="form-control form-control-sm" name="title" placeholder="Enter Social Setting Name">
                    </div>
                    <div class="form-group">
                        <label>Social Url</label>
                        <input type="text"  class="form-control form-control-sm" name="url" placeholder="Social Setting Url Name">
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <div class="form-group d-flex">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary position-relative" id="target" data-icon="fas fa-home" role="iconpicker"></button>
                            </span>
                            <input type="text" name="icon" class="form-control form-control-sm" id="icon" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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