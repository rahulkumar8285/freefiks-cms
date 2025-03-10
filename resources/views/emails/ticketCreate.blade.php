<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Created Successfully</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 15px;
            font-size: 20px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: left;
            color: #333;
        }
        .button {
            background: #007bff;
            color:rgb(255, 255, 255);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;

        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Ticket Created Successfully</div>
        <div class="content">
            <p>Dear <strong>{{$clientName}}</strong>,</p>
            <p>Thank you for choosing FastFiks. We are committed to providing the best support for your solutions.</p>
            <p>Your ticket has been successfully created. Below are your login details to check the status of your ticket:</p>
            <p><strong>Username:</strong> {{$clientEmail}}</p>
            <p><strong>Password:</strong> {{$clientPassword}}</p>
            <p><strong>Ticket ID:</strong> {{$ticketNumber}}</p>
            <p>You can track your ticket status by clicking the button below:</p>
            <a href="https://user.fastfiks.com" class="button">Check Ticket Status</a>
            <p>If you need any further assistance, feel free to reach out to our support team.</p>
            <p>Best Regards,</p>
            <p><strong>FastFiks Support Team</strong></p>
        </div>
        <div class="footer">
            &copy; 2025 FastFiks. All Rights Reserved.
        </div>
    </div>
</body>
</html>
