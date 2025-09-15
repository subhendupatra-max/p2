<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            padding: 30px;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c5282;
        }
        .otp-box {
            font-size: 24px;
            font-weight: bold;
            background-color: #edf2f7;
            color: #2d3748;
            padding: 10px 20px;
            display: inline-block;
            margin: 15px 0;
            border-radius: 6px;
            letter-spacing: 4px;
        }
        .note {
            font-size: 14px;
            color: #e53e3e;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">OTP Verification</div>

        <p>Welcome! Please use the OTP below to verify your account:</p>

        <div class="otp-box">{{ $otp }}</div>

        <p class="note">
            🔐 <strong>Note:</strong><br>
            - This OTP is valid for <strong>30 minutes</strong>.<br>
            - After <strong>3 incorrect attempts</strong>, the OTP will expire and you’ll need to request a new one.
        </p>

        <div class="footer">
            Regards,<br>
            {{ env('APP_NAME', 'Team') }}
        </div>
    </div>
</body>
</html>

