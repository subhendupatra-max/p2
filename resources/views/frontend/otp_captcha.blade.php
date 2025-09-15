
<div class="row">
    <div class="col-md-6 captcha">
        <span>{!! captcha_img('custom') !!}</span>
    </div>
    <div class="col-md-2">
    <button type="button" class="btn btn-success btn-refresh-capcha"><i class="fa fa-refresh"></i></button>
    </div>
    <div class="col-md-4">
        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <button type="button" class="btn btn-set-1 mt-4 otp_send_for_form_submit" id="sendOtpButton">
            <span class="indicator-label sendotp">Send OTP</span>
        </button>
    </div>
    <div class="col-md-4">
        <div class="col-md-4 otp" id="otpInput">
            <input type="number" class="form-control fromAlias" placeholder="Enter OTP" name="otp" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <span class="kxsakskcks"></span>
        </div>
    </div>
</div>



