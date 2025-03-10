<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Analysis & Payment Request</title>
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
            background: #28a745;
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
        <div class="header">Issue Analysis & Payment Request</div>
        <div class="content">
            <p>Dear <strong>{{$ticketInfo->client_name}}</strong>,</p>
            <p>We have analyzed your issue associated with Ticket ID: <strong>{{$ticketInfo->ticket_number}}</strong>.</p>
            <p>To proceed further, we require additional information. Kindly review the details below and provide the necessary information:</p>
            <p><strong>Required Information:</strong> {{$ticketInfo->project_type}}</p>
            <p><strong>Estimated Cost:</strong> {{$ticketInfo->project_cost}}</p>
            <p><strong>Resolution Time:</strong> {{$ticketInfo->work_expectation_days}}</p>
            <p>Additionally, a service charge is applicable to continue resolving your issue. Please complete the payment by clicking the button below:</p>
            <a href="www.thetechcare.in" class="button" style="color:#fff;" >Make Payment</a>
            <p>Once the payment is confirmed, our support team will continue to assist you promptly.</p>
            <p>Best Regards,</p>
            <p><strong>FastFiks Support Team</strong></p>
        </div>
        <div class="footer">
            &copy; 2025 FastFiks. All Rights Reserved.
        </div>
    </div>
</body>
</html>
