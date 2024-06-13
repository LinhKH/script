@extends('admin.layout')
@section('title','Edit Rating')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Rating'=>'admin/rating']])
        @slot('title') Edit Rating @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Rating @endslot
    @endcomponent
    <div class="col-12 mb-5">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Page Details</h4>
                <form class="forms-sample" id="updateReview" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" hidden class="url" value="{{url('admin/rating/'.$rating->review_id)}}">
                            <label class="mb-0 py-3">{{$rating->username}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Plan Name</label>
                        <div class="col-sm-9">
                            <label class="mb-0 py-3">{{$rating->plan}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Rating Name</label>
                        <div class="col-sm-9"> 
                            <input type="number" min=1 max=5 class="form-control form-control-sm" name="rating" value="{{$rating->star_rating}}" placeholder="Enter Rating Review">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control form-control-sm" name="comment" rows="5" placeholder="Place some text here">{!!$rating->comment!!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control form-control-sm" name="status" placeholder="Enter your Status">
                            <option value="1" {{$rating->status == '1' ? "selected":""}}>Show</option>
                            <option value="0" {{$rating->status == '0' ? "selected":""}}>Hide</option>
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


