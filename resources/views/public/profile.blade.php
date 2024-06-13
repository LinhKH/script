@include('public/layout/header')
@component('public.layout.breadcrumb',['breadcrumb'=>['Home'=>'/']])
    @slot('active') My Profile @endslot
@endcomponent
@component('public.partials.page-header')
    @slot('title') My Profile @endslot
@endcomponent
<div id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="user-image">
                    @if($user->image != '')
                        <img id="image" src="{{asset('user/'.$user->image)}}">
                    @else
                        <img id="image" src="{{asset('user/default.png')}}">
                    @endif
                    <input type="file" name="img" onChange="readURL(this);">
                    <input type="text" name="old_img" hidden value="{{$user->image}}">
                    <button class="btn btn-block change-user-image">Change Profile Image</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="user-info mb-5">
                    <div class="d-flex flex-row justify-content-between">
                        <h3>{{$user->username}}</h3>
                        <button class="btn align-self-center ShowProfile">Edit Profile</button>
                    </div>
                    <ul>
                        <li><b>Email :</b> {{$user->email}}</li>
                        <li><b>Phone Number :</b> {{$user->phone}}</li>
                        @if($user->city != NULL && $user->city != '')
                        <li><b>City :</b>{{($user->city)}}</li>
                        @endif
                        @if($user->state != NULL && $user->state != '')
                        <li><b>State :</b>{{$user->state}}</li>
                        @endif
                        <li><b>Country :</b> {{$user->country}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="EditProfile" class="position-relative" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="offset-md-2 col-md-8">
                                    <div class="message"></div>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-4 col-form-label">Your Name<span class="text-danger">*</span> :</label>
                                <div class="col-sm-8">
                                    <input type="type" class="form-control" name="username" value="{{$user->username}}">
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-4 col-form-label">Email<span class="text-danger">*</span> :</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" value="{{$user->email}}" disabled>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-4 col-form-label">Phone<span class="text-danger">*</span> :</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="phone" value="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-4 col-form-label">Country :</label>
                                <div class="col-sm-8">
                                    <textarea name="country" class="form-control">{{$user->country}}</textarea>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-4 col-form-label">State :</label>
                                <div class="col-sm-8">
                                    <textarea name="state" class="form-control">{{$user->state}}</textarea>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-4 col-form-label">City :</label>
                                <div class="col-sm-8">
                                    <textarea name="city" class="form-control">{{$user->city}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn" name="update" value="Update"/>
                        </div>
                    </form>
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
@section('pageJsScripts')
@stop
@include('public/layout/footer')