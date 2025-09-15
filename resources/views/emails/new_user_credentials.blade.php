<!DOCTYPE html>
<html>
<head>
    <title>Login Credentials</title>
</head>
<body>
    <p>Dear {{ $name }},</p>

    <p>Welcome! Your account has been successfully created.</p>

    <p><strong>Email:</strong> {{ $email }}<br>
       <strong>Password:</strong> {{ $password }}
       <br>
       <strong>Link:</strong> {{ $link }}</p>

    <p>Please login and change your password after your first login.</p>

    <p>Regards,<br> {{ env('APP_NAME', 'Team') }}</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        h2 {
            color: #34495e;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        li:last-child {
            border-bottom: none;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
            text-align: center;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2980b9;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to [Unit Name]</h1>
        <p>Dear [User's Name],</p>
        <p>We are pleased to inform you that you have been successfully added to the [Unit Name]. Your role within this unit is <strong>[User Role Name]</strong>.</p>

        <h2>Details of Your Role:</h2>
        <ul>
            <li><strong>Unit Name:</strong> [Unit Name]</li>
            <li><strong>User Role:</strong> [User Role Name]</li>
            <li><strong>Start Date:</strong> [Start Date]</li>
        </ul>

        <p>Please feel free to reach out to your contact person or the unit administrator if you have any questions or need further assistance.</p>
        <p>We are excited to have you on board and look forward to your contributions!</p>

        <a href="mailto:[Your Contact Information]" class="button">Contact Us</a>

        <div class="footer">
            <p>Best regards,</p>
            <p>[Your Name]<br>
            [Your Position]<br>
            [Your Organization]<br>
            [Your Contact Information]</p>
        </div>
    </div>
</body>
</html>

