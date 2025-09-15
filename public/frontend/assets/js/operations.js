$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$("form.formSubmit").on("submit", function (e) {
    e.preventDefault();
    var $this = $(this);
    var formActionUrl = $this.prop("action");

    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.setAttribute("data-kt-indicator", "on");
    submitButton.disabled = true;

    let fd;

    if ($($this).hasClass("fileUpload")) {
        fd = new FormData(document.getElementById($($this).attr("id")));
    } else {
        fd = $($this).serializeArray();
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
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
            $(".cookie-banner").slideUp();

            if (response.status) {
                toastr.success("Successfully");
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                toastr.error("Please Try Again");
            }
        },
        error: function (response) {
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;

            let responseJSON = response.responseJSON;
            $(".err_message").removeClass("d-block").hide();
            $("form .form-control").removeClass("is-invalid");

            $.each(responseJSON.errors, function (index, valueMessage) {
                $(`#${index}`).addClass("is-invalid");

                Swal.fire({
                    icon: "warning",
                    title: "Validation Error",
                    text: valueMessage,
                });
            });
        },
    });
});

$("form.formSubmitwithcapctha").on("submit", function (e) {
    e.preventDefault();
    var $this = $(this);
    var formActionUrl = $this.prop("action");

    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.setAttribute("data-kt-indicator", "on");
    submitButton.disabled = true;

    let fd;

    if ($($this).hasClass("fileUpload")) {
        fd = new FormData(document.getElementById($($this).attr("id")));
    } else {
        fd = $($this).serializeArray();
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
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;
            $(".cookie-banner").slideUp();

            if (response.status) {
                toastr.success("Successfully");
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                toastr.error("Please Try Again");
            }
        },
        error: function (response) {
            submitButton.removeAttribute("data-kt-indicator");
            submitButton.disabled = false;

            let responseJSON = response.responseJSON;
            $(".err_message").removeClass("d-block").hide();
            $("form .form-control").removeClass("is-invalid");

            $.each(responseJSON.errors, function (index, valueMessage) {
                $(`#${index}`).addClass("is-invalid");

                Swal.fire({
                    icon: "warning",
                    title: "Validation Error",
                    text: valueMessage,
                });
            });
        },
    });
});


