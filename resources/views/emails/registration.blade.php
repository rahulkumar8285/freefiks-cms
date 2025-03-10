<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to FastFiks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            background: #007bff;
            color: #ffffff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .button {
            display: inline-block;
            background: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $logo_url }}" alt="FastFiks Logo" class="logo">
            <h2>Welcome to Fastfiks!</h2>
        </div>
        <div class="content">
            <p>Hello <strong>{{$user->name}}</strong>,</p>
            <p>I am happy to have you on board. Please check below for your credentials:</p>
            <p><strong>Username:</strong> {{$user->email}}</p>
            <p><strong>Password:</strong> {{$password}}</p>
            <p>You can log in using the button below:</p>
            <a href="{{$login_url}}" class="button">Login Now</a>
        </div>
        <div class="footer">
            <p>If you did not create this account, please ignore this email.</p>
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
