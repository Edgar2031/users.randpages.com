let forgotPasswordSubmit = function () {
    $('#forgotPasswordEmailError1').html("");
    $.ajax({
        type: "post",
        url: "/forgot-password-email",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            emailID: $('#forgotPasswordEmailId').val()
        },
        beforeSend: function () {
        },
        success: function (response) {
            if (response.code === 200) {
                toastr.success(response.message);
                $('#forgotPasswordEmailId').val("");
                setTimeout(function () {
                    window.location = '/login';
                }, 1000);
            } else if (response.code === 201) {
                $("#forgotPasswordEmailError1").html(response.msg[0]);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (error) {
            toastr.error("Not able to load");
        }
    });
}
