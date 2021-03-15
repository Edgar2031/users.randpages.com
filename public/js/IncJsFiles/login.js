let emailLogin = function () {
    $('#emailLoginError1').html("");
    $.ajax({
        type: "post",
        url: "/email-login",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            emailID: $('#emailLoginId').val()
        },
        beforeSend: function () {
        },
        success: function (response) {
            if (response.code === 200) {
                toastr.success(response.message);
                $('#emailSignInModal').toggle();
            } else if (response.code === 201) {
                $("#emailLoginError1").html(response.message[0]);
            } else {
                toastr.error(response.message);
            }
        },
        error: function (error) {
            toastr.error("Not able to load");
        }
    });
}

$(document).ready(function () {
    $(document).on('submit', '#login_form', function (e) {
        e.preventDefault();
        var form = document.getElementById('login_form');
        var formData = new FormData(form);
        console.log(formData);

        $.ajax({
            url: '/login',
            data: formData,
            type: 'POST',
            processData: false,
            cache: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response['emailOrusername'] !== undefined) document.getElementById('validEmail').innerHTML = response['emailOrusername'];
                if (response['password'] !== undefined) document.getElementById('validPassword').innerHTML = response['password'];

                if (response.code == 200) {
                    document.getElementById("login_form").reset();
                    if (response['message'] == 'success') {
                        toastr.success("Your have logged in!", "Success");
                        setTimeout(function () {
                            window.location = '/dashboard';
                        }, 1000);
                    }
                } else if (response.code == 400) {
                    toastr.error(response.message);
                }else if (response.code == 401){
                    toastr.error(response.message);
                }else {
                    toastr.error(response.message, "Sign-In error!");
                }
            }
            ,
            error: function (error) {

            }
        })
    })
})
