function ratingUpdate(rating, accountId){
    console.log(rating, accountId);

    $.ajax({
        type: "post",
        url: '/update-rating',
        data: {accountId, rating},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response,"res");
            if (response.code == 200) {
                toastr.success(response.message, {
                    timeOut: 1000,
                    fadeOut: 1000,
                });
            } else if (response.code == 400) {
                toastr.error(response.message, {
                    timeOut: 1000,
                    fadeOut: 1000,
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function cronUpdate(accountId, cronvalue) {
    if(cronvalue == 1) cronvalue = 2;
    else cronvalue = 1;

    $.ajax({
        type: "post",
        url: '/update-cron',
        data: {accountId, cronvalue},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response,"res");
            if (response.code == 200) {
                let append = "";
                    $("#cronModify"+accountId).empty();
                append += '<label><input type="checkbox" id="cronUpdate'+accountId+'" name="select" onclick="cronUpdate('+accountId+','+cronvalue+');"';
                if(cronvalue == 2) append += 'checked';
                append += '><span></span>\n' +
                '</label>';
                $("#cronModify"+accountId).append(append);
                toastr.success(response.message, {
                    timeOut: 1000,
                    fadeOut: 1000,
                });
            } else if (response.code == 400) {
                toastr.error(response.message, {
                    timeOut: 1000,
                    fadeOut: 1000,
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}
