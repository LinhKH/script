$(function () {
    var uRL = $('.demo').val();
   // alert(uRL);

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.change-logo').click(function () {
        $('.change-com-img').click();
    });

    // delete data common function
    function destroy_data(name, url) {
        var el = name;
        var id = el.attr('data-id');
        var dltUrl = url + id;
        if (confirm('Are you Sure Want to Delete This')) {
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        el.parent().parent('tr').remove();
                    } else {
                        Toast.fire({
                            icon: 'danger',
                            title: dataResult
                        })
                    }
                }
            });
        }
    }

    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    // ========================================
    // script for Admin Logout
    // ========================================

    $('.admin-logout').click(function () {
        $.ajax({
            url: uRL + '/admin/logout',
            type: "GET",
            cache: false,
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    setTimeout(function () {
                        window.location.href = uRL + '/admin';
                    }, 500);
                    Toast.fire({
                        icon: 'success',
                        title: 'Logged Out Succesfully.'
                    })
                }
            }
        });
    });

    // ========================================
    // script for Users module
    // ========================================

    $("#editUser").validate({
        rules: {
            username: { required: true },
            phone: { required: true },
        },
        messages: {
            username: { required: "Please Enter User Name" },
            phone: { required: "Please Enter User Phone Number" },
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            alert(id);
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/users'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for All Plan module
    // ========================================

    $('#addPlan').validate({
        rules: {
            title: { required: true },
            category: { required: true },
            location: { required: true },
            duration: { required: true },
            start_time: { required: true },
            end_time: { required: true },
            capacity: { required: true },
            price: { required: true },
            includes: { required: true },
            excludes: { required: true },
            description: { required: true },
        },
        messages: {
            title: { required: "Please Enter Plan Name" },
            category: { required: "Please Enter Category Name" },
            location: { required: "Please Enter Location Name" },
            duration: { required: "Please Enter Duration Name" },
            start_time: { required: "Please Enter Start Time Name" },
            end_time: { required: "Please Enter End Time Name" },
            capacity: { required: "Please Enter Capacity Name" },
            price: { required: "Please Enter Price Name" },
            includes: { required: "Please Enter Includes Name" },
            excludes: { required: "Please Enter Excludes Name" },
            des: { required: "Please Enter Description Plan Name" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            formdata.append('gallery', $('input[name^=gallery]').prop('files'));
            $.ajax({
                url: uRL + '/admin/plans',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/plans'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editPlan").validate({
        rules: {
            title: { required: true },
            category: { required: true },
            location: { required: true },
            duration: { required: true },
            start_time: { required: true },
            end_time: { required: true },
            capacity: { required: true },
            price: { required: true },
            includes: { required: true },
            excludes: { required: true },
            description: { required: true },
            status: { required: true },
        },
        messages: {
            title: { required: "Please Enter Plan Name" },
            category: { required: "Please Enter Category Name" },
            location: { required: "Please Enter Location Name" },
            duration: { required: "Please Enter Duration Name" },
            start_time: { required: "Please Enter Start Time Name" },
            end_time: { required: "Please Enter End Time Name" },
            capacity: { required: "Please Enter Capacity Name" },
            price: { required: "Please Enter Price Name" },
            includes: { required: "Please Enter Includes Name" },
            excludes: { required: "Please Enter Excludes Name" },
            des: { required: "Please Enter Description Plan Name" },
            status: { required: "Please Enter Status Name" },
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            formdata.append('gallery', $('input[name^=gallery1]').prop('files'));
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/plans'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-plan", function () {
        destroy_data($(this), 'plans/')
    });

    
    // ========================================
    // script for Category module
    // ========================================

    $('#addCategory').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Category Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/categories',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/categories'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#updateCategory").validate({
        rules: { 
            category: { required: true }, 
            category_slug: { required: true },
            status: { required: true }, 
        },
        messages:{ 
            category: { required: "Please Enter Category Name" }, 
            category_slug: { required: "Please Enter Category Slug Name" }, 
            status: { required: "Please Enter Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                   if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/categories'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-category", function () {
        destroy_data($(this), ' categories/')
    });

     // ========================================
    // script for Location module
    // ========================================
   
    $('#addLocation').validate({
           rules: { location: { required: true }, },
        messages: { location: { required: "Please Enter Location Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/location',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/location'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#updateLocation").validate({
        rules: {
            location: { required: true },
            status: { required: true },
        },
        messages:{ 
            location: { required: "Please Enter Location Name" },
            status: { required: "Please Enter Location Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/location'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-location", function () {
        destroy_data($(this), 'location/')
    });

     // ========================================
    // script for Blog Category module
    // ========================================

    $('#addBlogCat').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Blog Category Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/b-category',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/b-category'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#updateBlogCat").validate({
        rules: { 
            title: { required: true },        
            slug: { required: true },
            status: { required: true }, 
        },
        messages:{ 
            title: { required: "Please Enter Blog Category Name" }, 
            slug: { required: "Please Enter Blog Category Slug Name" }, 
            status: { required: "Please Enter Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/b-category'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-blogCat", function () {
        destroy_data($(this), 'b-category/')
    });

    // ========================================
    // script for Blog module
    // ========================================
    
    $('#addBlog').validate({
        rules: {
            title: { required: true },
            category: { required: true },
            des: { required: true },
        },
        messages: {
            title: { required: "Please Enter Blog Title Name" },
            category: { required: "Please Enter Blog Category Name" },
            des: { required: "Please Enter Blog Description" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/blogs',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/blogs'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#updateBlog").validate({
        rules: {
            title: { required: true },
            category: { required: true },
            description: { required: true },
            status: { required: true },
        },
        messages:{ 
            title: { required: "Please Enter Blog Title Name" },
            category: { required: "Please Enter Blog Category Name" },
            description: { required: "Please Enter Blog Description" },
            status: { required: "Please Enter Blog Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/blogs'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-blog", function () {
        destroy_data($(this), 'blogs/')
    });

    // ========================================
    // script for General Setting module
    // ========================================

    $('#updateGeneralSetting').validate({
        rules: {
            com_name: { required: true },
            com_email: { required: true },
            address: { required: true },
            phone: { required: true },
            f_address: { required: true },
            cur_format: { required: true },
            des: { required: true },
        },
        messages: {
            com_name: { required: "Company Name is Required" },
            com_email: { required: "Company Email is Required" },
            address: { required: "Company Address is Required" },
            phone: { required: "Company Phone is Required" },
            f_copyright: { required: "Company Footer Address is Required" },
            cur_format: { required: "Currency Format is Required" },
            des: { required: "Comapny Description is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/general-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/general-settings'; }, 1000);
                    }else if (dataResult == '0') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Admin  module
    // ========================================

    $('#updateProfileSetting').validate({
        rules: {
            admin_name: { required: true },
            email: { required: true },
            username: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/profile-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else if(dataResult == '0'){
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });


    $('#updatePassword').validate({ 
        rules: {
            password: { required: true },
            new: { required: true },
            new_confirm: { equalTo:'#password' },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else if(dataResult == '0'){
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated'
                        });
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: dataResult
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    // ========================================
    // script for Banner Setting module
    // ========================================

    $('#updateBannerSetting').validate({
        rules: {
            title: { required: true },
            sub_title: { required: true },
            status: { required: true },
        },
        messages: {
            title: { required: "Title Name is Required" },
            sub_title: { required: "Banner Sub Title is Required" },
            status: { required: "Banner Status is Required" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/banner-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/banner-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

     // ========================================
    // script for Social Setting
    // ========================================

    $('#addSocial').validate({
        rules: {
            title: {required: true},
            url: {required: true},
            icon: {required: true},
            status: {required: true}
        },
        messages: {
           title: {required: "Please Enter Social Setting Name"},
            url: {required: "Please Enter Social Setting url Name"},
            icon: {required: "Please Enter Social Setting Icon"},
            status: {required: "Please Enter Social Setting Status"},
        },
        submitHandler: function(form){
            var formdata = new FormData(form);
            $.ajax({
                url: uRL+'/admin/social-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Successfully.'
                        });
                        setTimeout(function(){ window.location.href = uRL+'/admin/social-settings';}, 1000);
                    }
                },
                error: function(error){
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updateSocial').validate({
        rules: {
            title: {required: true},
            url: {required: true},
            icon: {required: true},
            status: {required: true}
        },
        messages: {
            title: {required: "Please Enter Social Setting Name"},
            url: {required: "Please Enter Social Setting url Name"},
            icon: {required: "Please Enter Social Setting Icon"},
            status: {required: "Please Enter Social Setting Status"},
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/social-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-social", function() {
        destroy_data($(this),'social-settings/')
    });

    // ========================================
    // script for Page module
    // ========================================
    $('#addPage').validate({
        rules: {
            title: { required: true },
            // page_content: { required: true },
        },
        messages: {
            title: { required: "Please Enter Page Title Name" },
            // page_content: { required: "Please Enter Page Content Description" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/pages',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Page Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updatePage').validate({
        rules: {
            page_title: { required: true },
            // page_slug: { required: true },
            // page_content: { required: true },
            // status: { required: true },
        },
        messages: {
            page_title: { required: "Please Enter Page Title Name" },
            // service_slug: { required: "Please Enter Page Slug Name" },
            // page_content: { required: "Please Enter Page Content Description" },
            // status: { required: "Please Enter Page Status" },
        },

        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Page Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/pages'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-page", function (){
        destroy_data($(this), 'pages/')
    });

    $(document).on('click','.show-in-header',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('head','');
        $.ajax({
            url: uRL + '/admin/page_showIn_header', 
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }

        });
    })

    $(document).on('click','.show-in-footer',function(){
        var id = $(this).attr('id');
        if($('#'+id).is(':checked')){
           var status = 1;
        }else{
            var status = 0;
        }
        id = id.replace('foot','');
        $.ajax({
            url: uRL + '/admin/page_showIn_footer',
            type: 'POST',
            data: {id:id,status:status},
            success: function (dataResult) {
            }
        });
    })

     // ========================================
    // script for Blog Comment module
    // ========================================

    $("#editComment").validate({
           rules: { comment: { required: true }, },
        messages: { comment: { required: "Please Enter User Comment" }, },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/comment'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-comment", function () {
        destroy_data($(this), 'comment/')
    });
   
    // ========================================
    // script for Rating Review module
    // ========================================

    $('#updateReview').validate({
        rules: {
            comment: { required: true },
            status: { required: true },
        },
        messages: {
            comment: { required: "Please Enter Review Comment" },
            status: { required: "Please Enter Review Rating Status" },
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/rating'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
 
    $(document).on("click", ".delete-review", function (){
        destroy_data($(this), 'rating/')
    });
});