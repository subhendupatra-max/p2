$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(document).ready(function () {
    const baseUrl = "{{ env('APP_URL') }}";
});

$("form.formSubmit").on("submit", function (e) {
    e.preventDefault();
    var $this = $(this);
    var formActionUrl = $this.prop("action");

    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.setAttribute("data-kt-indicator", "on");
    submitButton.disabled = true;

    if ($($this).hasClass("fileUpload")) {
        var fd = new FormData(document.getElementById($($this).attr("id")));
    } else {
        var fd = $($this).serialize();
    }
    let commonOption = {
        type: "post",
        url: formActionUrl,
        data: fd,
        dataType: "json",
    };
    if ($($this).hasClass("fileUpload")) {
        commonOption["cache"] = false;
        commonOption["processData"] = false;
        commonOption["contentType"] = false;
    }
    var captcha = $("#captcha").val();
    var captcharefreshAction = atob($("#captcharefreshAction").val());
    if (captcha === "") {
         toastr.error("CAPTCHA is required");
         submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
        return;
    } else if (captcha.trim().toLowerCase() !== currentCaptchaText.trim().toLowerCase()) {
         toastr.error("CAPTCHA does not match");
         submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
        return;
    }
    $.ajax({
        ...commonOption,
        beforeSend: function () { },
        success: function (response) {
            if (response.status) {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                if (response.url) {
                    // Swal.fire({
                    //     icon: "success",
                    //     title: response.message,
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.success(response.message);
                    setTimeout(() => {
                        $(location).attr("href", response.url);
                    }, 1500);
                } else {
                    // Swal.fire({
                    //     icon: "success",
                    //     title: response.message,
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            } else {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                // Swal.fire({
                //     icon: "error",
                //     title: response.message,
                //     showConfirmButton: false,
                //     timer: 5000,
                // });
                toastr.error(response.message);
            }
        },
        error: function (response) {
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
            let responseJSON = response.responseJSON;
            $(".err_message").removeClass("d-block").hide();
            $("form .form-control").removeClass("is-invalid");
            $.each(responseJSON.errors, function (index, valueMessage) {
                toastr.warning(valueMessage);
                $(`#${index}`).addClass("is-invalid");
                // $(`#${index}`).after(
                //     `<p class='d-block text-danger err_message'> ${valueMessage}</p>`
                // );
            });
        },
    });
});

$("form.formSubmitWithoutCatcha").on("submit", function (e) {
    e.preventDefault();
    var $this = $(this);
    var formActionUrl = $this.prop("action");

    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.setAttribute("data-kt-indicator", "on");
    submitButton.disabled = true;

    if ($($this).hasClass("fileUpload")) {
        var fd = new FormData(document.getElementById($($this).attr("id")));
    } else {
        var fd = $($this).serialize();
    }
    let commonOption = {
        type: "post",
        url: formActionUrl,
        data: fd,
        dataType: "json",
    };
    if ($($this).hasClass("fileUpload")) {
        commonOption["cache"] = false;
        commonOption["processData"] = false;
        commonOption["contentType"] = false;
    }

    $.ajax({
        ...commonOption,
        beforeSend: function () { },
        success: function (response) {
            if (response.status) {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                if (response.url) {
                    // Swal.fire({
                    //     icon: "success",
                    //     title: response.message,
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.success(response.message);
                    setTimeout(() => {
                        $(location).attr("href", response.url);
                    }, 1500);
                } else {
                    // Swal.fire({
                    //     icon: "success",
                    //     title: response.message,
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            } else {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                // Swal.fire({
                //     icon: "error",
                //     title: response.message,
                //     showConfirmButton: false,
                //     timer: 5000,
                // });
                toastr.error(response.message);
            }
        },
        error: function (response) {
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
            let responseJSON = response.responseJSON;
            $(".err_message").removeClass("d-block").hide();
            $("form .form-control").removeClass("is-invalid");
            $.each(responseJSON.errors, function (index, valueMessage) {
                toastr.warning(valueMessage);
                $(`#${index}`).addClass("is-invalid");
                // $(`#${index}`).after(
                //     `<p class='d-block text-danger err_message'> ${valueMessage}</p>`
                // );
            });
        },
    });
});

$(".table").on("click", ".deleteData", function (e) {
    const actionUrl = baseUrl + "/ajax/delete/data";
    var $this = $(this);
    var uuid = $this.data("uuid");
    var find = $this.data("table");
    Swal.fire({
        title: "Are you sure you want to delete it?",
        text: "You wont be able to revert this action!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "delete",
                url: actionUrl,
                data: { uuid: uuid, find: find },
                cache: false,
                dataType: "json",
                beforeSend: function () { },
                success: function (response) {
                    if (response.status) {
                        // Swal.fire({
                        //     icon: "success",
                        //     title: "Deleted Successfully",
                        //     showConfirmButton: false,
                        //     timer: 1500,
                        // });
                        toastr.success("Deleted Successfully");
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        // Swal.fire({
                        //     icon: "error",
                        //     title: "We are facing some technical issue now",
                        //     showConfirmButton: false,
                        //     timer: 2000,
                        // });
                        toastr.error("We are facing some technical issue now");
                    }
                },
                error: function (response) {
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "We are facing some technical issue now. Please try again after some time",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.error(
                        "We are facing some technical issue now. Please try again after some time"
                    );
                },
            });
        }
    });
});

$(".table").on("click", ".convertActiveArchivedData", function (e) {
    const actionUrl = baseUrl + "/ajax/convert-active/data";
    var $this = $(this);
    var uuid = $this.data("uuid");
    var find = $this.data("table");
    Swal.fire({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, do it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url: actionUrl,
                data: { uuid: uuid, find: find },
                cache: false,
                dataType: "json",
                beforeSend: function () { },
                success: function (response) {
                    if (response.status) {
                        // Swal.fire({
                        //     icon: "success",
                        //     title: "Deleted Successfully",
                        //     showConfirmButton: false,
                        //     timer: 1500,
                        // });
                        toastr.success("Successfully");
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        // Swal.fire({
                        //     icon: "error",
                        //     title: "We are facing some technical issue now",
                        //     showConfirmButton: false,
                        //     timer: 2000,
                        // });
                        toastr.error("We are facing some technical issue now");
                    }
                },
                error: function (response) {
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "We are facing some technical issue now. Please try again after some time",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.error(
                        "We are facing some technical issue now. Please try again after some time"
                    );
                },
            });
        }
    });
});

$(".table").on("click", ".isVerified", function (e) {
    e.preventDefault();
    const uuid = $(this).attr("data-uuid");
    const find = $(this).attr("data-table");
    const action = baseUrl + "/ajax/status/change";
    Swal.fire({
        title: "Are you sure you want to change it?",
        text: "The status will be changed",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Change it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: action,
                method: "POST",
                data: {
                    status: this.value == 0 ? 1 : 0,
                    uuid: uuid,
                    find: find,
                },
                async: false,
                success: function (data) {
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "Status Changed Successfully",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.success("Status Changed Successfully");
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                },
                error: function (response) {
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "We are facing some technical issue now. Please try again after some time",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.error(
                        "We are facing some technical issue now. Please try again after some time"
                    );
                },
            });
        }
    });
});

$(".isApproved").on("click", function (e) {
    e.preventDefault();
    const uuid = $(this).attr("data-uuid");
    const field = $(this).attr("data-field");
    const value = $(this).attr("data-value");
    const mesg = $(this).attr("data-mesg");
    const action = baseUrl + "/ajax/approved/change";
    Swal.fire({
        title: mesg,
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Change it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: action,
                method: "POST",
                data: {
                    field: field,
                    uuid: uuid,
                    value: value,
                },
                async: false,
                success: function (data) {
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "Status Changed Successfully",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.success("Successfully");
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                },
                error: function (response) {
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "We are facing some technical issue now. Please try again after some time",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                    toastr.error(
                        "We are facing some technical issue now. Please try again after some time"
                    );
                },
            });
        }
    });
});

$(document).ready(function () {
    $('.loader_otp').hide(); // Hide the spinner on page load
});

$(".otp_send_for_form_submit").on("click", function (e) {
    const actionUrl = baseUrl + "/ajax/otp-send";
    const $button = $(this); // cache the button

    Swal.fire({
        title: "Are you sure you want to send OTP?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, send it!",
    }).then((result) => {
        if (result.isConfirmed) {

            const originalText = $button.html(); // store original button text
            $button.prop("disabled", true).html("Please wait..."); // show loading text

            $.ajax({
                type: "GET",
                url: actionUrl,
                cache: false,
                success: function (response) {
                    $button.prop("disabled", false).html(originalText); // restore button
                    if (response.status) {
                        toastr.success("OTP Sent Successfully");
                        $(".otp").slideDown();
                        $('.kxsakskcks').html(response.otp);
                        $('.sendotp').html("Resend OTP");
                    } else {
                        toastr.error("We are facing some technical issue now");
                        $(".otp").hide();
                    }
                },
                error: function () {
                    $button.prop("disabled", false).html(originalText); // restore button
                    toastr.error("We are facing some technical issue now. Please try again after some time");
                    $(".otp").hide();
                }
            });
        }
    });
});


$(".btn-refresh-capcha").click(function () {
    const action = baseUrl + "/admin/refresh_captcha";
    const $button = $(this);
    const originalText = $button.html(); // store original button text
    $button.prop("disabled", true).html("Please wait..."); // show loading text

    $.ajax({
        type: 'GET',
        url: action,
        beforeSend: function () {
            $button.html("<div class='spinner-border spinner-border-sm text-light' role='status'></div>");
        },
        success: function (data) {
            $button.prop("disabled", false).html(originalText); // restore button
            $(".captcha span").html(data.captcha);
        }

    });
});

$(".contantStatusChnage").on("change", function (e) {
    e.preventDefault();
    const id = $(this).attr("data-id");
    const field = $(this).attr("data-field");
    const value = $(this).val();
    const action = baseUrl + "/ajax/content-status-change";
    if (value != '') {
        Swal.fire({
            title: "Are you sure you want to change it?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: action,
                    method: "POST",
                    data: {
                        id: id,
                        value: value,
                        field: field
                    },
                    async: false,
                    success: function (data) {
                        toastr.success("Successfully");
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function (response) {
                        toastr.error(
                            "We are facing some technical issue now. Please try again after some time"
                        );
                    },
                });
            }
        });
    }

});


