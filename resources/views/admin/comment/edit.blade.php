@extends('admin.layout')
@section('title','Edit Comment')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Comment'=>'admin/comment']])
        @slot('title') Edit Comment @endslot
        @slot('add_btn')  @endslot
        @slot('active') Edit Comment @endslot
    @endcomponent
        <form class="form-sample" id="editComment" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            @if($comment)
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Comment Details</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comment</label>
                                    <input type="hidden" class="url" value="{{url('admin/comment/'.$comment->id)}}">
                                    <textarea type="text" class="form-control" rows="5" name="comment">{{$comment->comment}}</textarea>
                                </div>  
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Status</label>
                                    <select class="form-control form-control-sm" name="status" placeholder="Enter your Status Name">
                                        <option value="" selected disabled>Select Status</option>    
                                        <option value="1"  {{($comment->status == "1" ? "selected":"") }}>Active</option>
                                        <option value="0"  {{($comment->status == "0" ? "selected":"") }}>Inactive</option>
                                    </select>
                                </div>
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

