$(function () {
    var uRL = $('.site-url').val();
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('#adminLogin').validate({
        rules: {
            username: { required: true },
            password: { required: true }
        },
        messages: {
            username: { required: "Username is required" },
            password: { required: "Pasword is required" }
        },
        submitHandler: function (form) {

            var formdata = new FormData(form);
            $.ajax({
                url: uRL,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    // console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Logged In Succesfully.'
                        })
                        setTimeout(function(){
                            window.location.href = uRL+'/dashboard';
                        }, 500);
                    } else {
                        console.log(dataResult);
                        $.each(dataResult, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]').css('border-color','red');
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        });
                    }
                }
            });
        }
    });
});