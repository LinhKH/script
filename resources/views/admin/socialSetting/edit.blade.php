@extends('admin.layout')
@section('title','Edit Social Settings')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Social Setting'=>'admin/social-settings']])
        @slot('title') Edit Social Settings @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Social Settings @endslot
    @endcomponent
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Social Setting Details</h4>
                <form class="forms-sample" id="updateSocial"  method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    @if($social)
                    <div class="form-group">
                        <label>Social Name</label>
                        <input type="hidden" class="url" value="{{url('admin/social-settings/'.$social->id)}}" >
                        <input type="text" class="form-control form-control-sm" name="title" value="{{$social->title}}" placeholder="Enter Social Setting Name">
                    </div>
                    <div class="form-group">
                        <label>Social Url</label>
                        <input type="text"  class="form-control form-control-sm" name="url" value="{{$social->url}}" placeholder="Social Setting Url Name">
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <div class="input-group">
                            <input type="text" name="icon" class="form-control form-control-sm" id="icon" value="{{$social->icon}}">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary" id="target" data-icon="fas fa-home" role="iconpicker"></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status">
                            <option value="1" {{$social->status == '1' ? "selected":""}}>Active</option>
                            <option value="0" {{$social->status == '0' ? "selected":""}}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary">Update</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
</div>
@stop