@extends('admin.layout')
@section('title','General Settings')
@section('content')
<div class="main-panel">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
        @slot('title') General Settings @endslot
        @slot('add_btn')  @endslot
        @slot('active') General Settings @endslot
    @endcomponent
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="form-sample" id="updateGeneralSetting" method="POST">
                    {{ csrf_field() }}
                    @foreach($data as $item)
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Company Logo</label>
                                <input type="hidden" class="file-upload-default" name="old_logo" value="{{$item->com_logo}}" />
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control form-control-sm file-upload-info" name="logo" placeholder="Upload Image" onChange="readURL(this);" style="line-height: 25px;">
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            @if(empty($item->com_logo))
                                <img id="image" src="{{asset('public/site-img/default.jpg')}}" width="100px" >
                            @else
                                <img id="image" src="{{asset('public/site-img/'.$item->com_logo)}}" width="100px">
                            @endif
                        </div>     
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="com_name" value="{{$item->com_name}}" placeholder="Enter your Company Name" aria-label="Company Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="com_email" value="{{$item->com_email}}" placeholder="Enter your Company Email" aria-label="Company Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Company Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="address"  value="{{$item->address}}" placeholder="Enter your Company Address" aria-label="Company Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="phone" value="{{$item->com_phone}}" placeholder="Enter your Phone" aria-label="Phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CopyRight Text</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="f_copyright" value="{{$item->footer_copyright}}" placeholder="Enter your CopyRight Text" aria-label="CopyRight Text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Currency Format</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm" name="cur_format" value="{{$item->cur_format}}" placeholder="Enter your Currency" aria-label="Currency">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" rows="5" name="des">{{$item->description}}</textarea>
                            </div>  
                        </div>      
                    </div>
                    <button type="submit" class="btn btn-sm btn-gradient-primary mb-2">Submit</button>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
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