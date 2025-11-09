<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: bold;
            color: #ff6b35;
            margin-bottom: 5px;
        }
        .field-value {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #ff6b35;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #ff6b35;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
        <p>You have received a new message from the website contact form</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="field-label">Full Name:</div>
            <div class="field-value">{{ $contactData['firstName'] }} {{ $contactData['lastName'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email Address:</div>
            <div class="field-value">{{ $contactData['email'] }}</div>
        </div>

        @if(!empty($contactData['phone']))
        <div class="field">
            <div class="field-label">Phone Number:</div>
            <div class="field-value">{{ $contactData['phone'] }}</div>
        </div>
        @endif

        <div class="field">
            <div class="field-label">Message:</div>
            <div class="message-box">{{ $contactData['message'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Submitted At:</div>
            <div class="field-value">{{ $contactData['submitted_at'] }}</div>
        </div>
    </div>

    <div class="footer">
        <p>This email was sent from the {{ config('app.name') }} contact form.</p>
        <p>Please respond to the customer at their earliest convenience.</p>
    </div>
</body>
</html>
