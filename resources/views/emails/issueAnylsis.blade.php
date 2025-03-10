<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Analysis in Progress</title>
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
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Issue Analysis in Progress</div>
        <div class="content">
            <p>Dear <strong>{{$ticketInfo->client_name}}</strong>,</p>
            <p>We appreciate your patience. Our team is currently analyzing the issue associated with Ticket ID: <strong>{{$ticketInfo->ticket_number}}</strong>.</p>
            <p>We will provide you with an update shortly regarding the progress and next steps.</p>
            <p>Should you have any urgent concerns, feel free to reach out to our support team.</p>
            <p>Best Regards,</p>
            <p><strong>FastFiks Support Team</strong></p>
        </div>
        <div class="footer">
            &copy; 2025 FastFiks. All Rights Reserved.
        </div>
    </div>
</body>
</html>
