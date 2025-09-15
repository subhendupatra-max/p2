
<div class="capcha-sec">
  <input type="hidden" value="{{ base64_encode(route('admin.refresh.captcha')) }}" id="captcharefreshAction">
    <div class="imag" id="captcha-container">
        <span id="captchaImg" aria-label="Captcha image">
            <p id="captcha-text" aria-hidden="true" style="text-align-last: center;"></p>
        </span>
    </div>
    <button type="button" title="Refresh the CAPTCHA code" class="btn btn-set-1 btn-refresh" onclick="refreshCaptcha()">
        <i class="fa fa-refresh"></i>
    </button>
    <div role="alert" id="announce" class="visually-hidden"></div>
    <button type="button" title="Speak the CAPTCHA code" id="refresh" class="btn btn-set-1 btn-refresh"
        onclick="playCombinedAudio()">
        <i class="fa fa-play"></i>
    </button>
    <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Enter Captcha" required>
</div>
<div class="row">
    <div class="col-md-2">
        <button type="button" class="btn btn-set-1 mt-4 otp_send_for_form_submit" id="sendOtpButton">
            <span class="indicator-label sendotp">Send OTP</span>
        </button>
    </div>
    <div class="col-md-4">
        <div class="col-md-4 otp" id="otpInput">
            <input type="number" class="form-control fromAlias" placeholder="Enter OTP" name="otp" maxlength="6"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <span class="kxsakskcks"></span>
        </div>
    </div>
</div>
