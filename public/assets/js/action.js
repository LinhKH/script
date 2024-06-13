$(function(){
    var uRL = $('.site-url').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $('.preloader').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    var preloader = `<div class="preloader">
    <div class="loader">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>`;

    // ========================================
    // script for User SignUp module
    // ========================================

    $('#user-signup').validate({
        rules: {
            username: { required: true },
            phone: { required: true },
            country: { required: true },
            email: { required: true },
            password: { required: true },
            confirm_password: { required: true,equalTo: '#password' },
        },
        messages: {
            username: { required: "Your Name is required" },
            phone: { required: "Phone Number is required" },
            country: { required: "Country Name is required" },
            email: { required: "Email Address is required" },
            password: { required: "Password is required" },
            confirm_password: { required: "Confirm Password is required" },
        },
        submitHandler: function (form) {
            $('.message').empty();
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/signup',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.preloader').remove();
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Registration Successfull Please Login with Email and Password.</div>');
                        setTimeout(function(){ window.location.href = uRL+'/login'; }, 3000);
                    } else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });


    // ========================================
    // script for User Login
    // ========================================

    $('#user-login').validate({
        rules: {
            email: { required: true },
            password: { required: true }
        },
        messages: {
            email: { required: "Email Address is required" },
            password: { required: "Password is required" }
        },
        submitHandler: function (form) {
            $('.message').empty();
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/login',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    $('.preloader').remove();
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Logged In Succesfully.</div>');
                        
                        setTimeout(function(){ window.location.href = uRL; }, 1500);
                    } else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

     // ========================================
    // script for Change Password User module
    // ========================================

    $('#updatePassword').validate({
        rules: {
            old_password: { required: true },
            password: { required: true },
            confirm_password: { required: true,equalTo:'#password' }
        },
        messages: {
            old_password: { required: "Password is required" },
            password: { required: "New Password is required" },
            confirm_password: { required: "New Confirm Password is required" }
        },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.preloader').remove();
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Password Changed Succesfully.</div>');
                        setTimeout(function(){ window.location.href = uRL + '/profile'; }, 3000);
                    } 
                    else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    // ========================================
    // script for Update Profile module
    // ========================================
    $(document).on('click', '.ShowProfile', function () {
        $('#exampleModal').modal('show');
    });

    $('#EditProfile').validate({
        rules: {
            username: { required: true },
            phone: { required: true },
        },
        messages: {
            username: { required: "Name is required" },
            phone: { required: "Phone is required" },
        },
        submitHandler: function (form) {
            $('.message').empty();
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/profile',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult){
                    $('.preloader').remove();
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Profile Updated Successfully.</div>');
                        setTimeout(function () { $('#exampleModal').modal('hide'); }, 2000);
                        setTimeout(function () { window.location.href = uRL + '/profile'; }, 2000);
                    } else {
                        $('.message').append('<div class="alert alert-danger">' + dataResult + '</div>');
                    }
                },
                error: function (dataResult){
                    show_formAjax_error(dataResult);
                }
            });
        }
    });

    $('.change-user-image').click(function(){
        $('input[name=img]').trigger('click');
    })

    $('input[name=img]').change(function(){
        var file_data = $(this).prop('files')[0];   
        var form_data = new FormData();                  
        var old_img = $('input[name=old_img]').val();                  
        form_data.append('img', file_data);
        form_data.append('old_img', old_img);
        $.ajax({
            url: uRL+'/user/change-image', 
            data: form_data,                         
            type: 'post',
            contentType: false,
            processData: false,
            success: function(dataResult){
                console.log(dataResult);
                if(dataResult == '1'){
                    $('.user-image').append('<div class="alert alert-success mt-2">Profile Image Changes Sucesssfully.</div>');
                    setTimeout(function(){ $('.alert').remove(); },2000);
                }
            }
        });
    })

     // ========================================
    // script for User Forgot Password module
    // ========================================

    $('#user-forgotPassword').validate({
        rules: { email: { required: true } },
        messages: { email: { required: "Email Address is required" } },
        submitHandler: function (form) {
            $('.message').empty();
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/forgot-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    var res = JSON.parse(dataResult);
                    $('.preloader').remove();
                    if(res.success){
                        $('.message').append('<div class="alert alert-success">'+res.success+'</div>');
                    }else{
                        $('.message').append('<div class="alert alert-danger">'+res.error+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    $('#user-resetPassword').validate({
        rules: { 
            password: { required: true } ,
            confirm_password: { required: true,equalTo: '#password' }
        },
        messages: { 
            password: { required: "Password is required" },
            confirm_password: { required: "Confirm password is required" },
        },
        submitHandler: function (form) {
            $('.message').empty();
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/update-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.preloader').remove();
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success">Success.</div>');
                        setTimeout(function(){ window.location.href = uRL + '/login'; }, 3000);
                    } else {
                       $('.message').append('<div class="alert alert-danger">'+dataResult+'</div>');
                    }
                },
                error: function(data){
                    show_formAjax_error(data)
                }
            });
        }
    });

    // ========================================
    // script for User ContactUs module
    // ========================================
    
    $('#addContactUs').validate({
        rules: {
            username: { required: true },
            email: { required: true },
            phone: { required: true },
            description: { required: true }
        },
        messages: {
            username: { required: "Please Enter Your Name" },
            email: { required: "Please Enter Your Email address" },
            phone: { required: "Please Enter Your Phone" },
            description: { required: "Please Enter Description" }
        },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/contact',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success"> Your Message Sended Successfully.</div>');
                        setTimeout(function () { window.location.href = uRL + '/contact'; }, 3000);
                    } else {
                        $('.message').append('<div class="alert alert-danger">' + dataResult + '</div>');
                    }
                },
                error: function (data) {
                    show_formAjax_error(data)
                }
            });
        }
    });

    // ========================================
    // script for Blog Comments module
    // ========================================
    
    $(document).on('submit','#addComment',function(e){
        e.preventDefault();
        var comment = $('.comment-body').val();
        var blog = $('.comment-blog').val();
        var parent = $('.comment-parent').val();
       if(comment == ''){
            $('.message').html('<div class="alert alert-danger">Comment is Empty.</div>');
        }else{
            $.ajax({
                url: uRL+"/comment-store",
                type: "POST",
                data: {blog:blog,comment:comment,parent:parent},
                success: function (data) {
                    console.log(data);
                    if(data == '1'){
                        $('.comment-body').val('');
                        $('.message').html('<div class="alert alert-info">'+
                        '<strong>Submitted Succesfully!!!. Your Comment Under Authorization Process</strong>'+
                        '</div>');
                        $('.alert.alert-info').delay(5000).fadeOut();

                    }else{
                        $('.comment-body').val('');
                        $('.message').html('<div class="alert alert-info">'+
                        '<strong>'+data+'</strong>'+
                        '</div>');
                        $('.alert.alert-info').delay(2000).fadeOut();
                    }
                }
            });
        }
    });


    $(document).on('click','#reply',function(){
        var parent_id = $(this).attr('data-id');
        var blog_id = $(this).attr('data-blog');
        $(' #addComment').remove();
            var form = `<form class="pt-3" id="addComment" method="POST">
            <div class="message"></div>
            <div class="content-box">
                <div class="mb-3">
                    <input type="hidden" class="comment-blog" value="`+blog_id+`"> 
                    <input type="hidden" class="comment-parent" value="`+parent_id+`"/>
                    <label class="col-form-label">Comment :</label>
                    <textarea class="form-control comment-body"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary link-btn">Post Comment</button>
        </form>`;
        $(this).parent('.display-comment').append(form);
    })


    // ========================================
    // script for User Review Rating module
    // ========================================
    
    $('#addReview').validate({
        rules: { comment: { required: true }, },
        messages: { comment: { required: "Please Enter Your Comment" }, },
        submitHandler: function (form) {
            $('.message').empty();
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/review',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('.message').append('<div class="alert alert-success"> Your Review Comment Send Successfully.</div>');
                        setTimeout(function () { window.location.reload(); }, 1000);
                    } else {
                        $('.message').append('<div class="alert alert-danger"> Please Enter Your Login</div>');
                        setTimeout(function () { window.location.href = uRL + '/login'; }, 500);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data)
                }
            });
        }
    });
  
    //========================================
    // change amount on quantity change in checkout page
    //========================================
    
    $(document).on('change','.item-qty',function(){
        var qty = $(this).val();
        var price = $(this).siblings('.plan-price').val();
        var new_price = (qty * price);
        $('.total-amount').html(new_price);
    });
})