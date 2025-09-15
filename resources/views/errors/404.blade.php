<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #f8fafc;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            color: #333;
        }
        .error-container {
            max-width: 600px;
            margin: auto;
        }
        h1 {
            font-size: 120px;
            margin: 0;
            color: #2c3e50;
        }
        h2 {
            margin: 10px 0;
            font-size: 28px;
        }
        p {
            margin: 15px 0;
            font-size: 18px;
            color: #666;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #3498db;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        a:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>Oops! Page not found</h2>
        <p>The page you’re looking for doesn’t exist or has been moved.</p>
        <a href="{{ url('/') }}">Go Back Home</a>
    </div>
</body>
</html>
