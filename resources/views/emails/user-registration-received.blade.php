<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Received</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; padding: 12px 24px; background: #059669; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
        .footer { margin-top: 30px; text-align: center; color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bangladesh Debate Federation</h1>
        </div>
        <div class="content">
            <h2>Thank you for registering, {{ $name }}!</h2>
            
            <p>We have received your registration request. Your account is currently pending approval from our admin team.</p>
            
            <p><strong>Registration Details:</strong></p>
            <ul>
                <li>Email: {{ $email }}</li>
                <li>Submitted: {{ $timestamp }}</li>
                <li>Status: <span style="color: #f59e0b;">Pending Approval</span></li>
            </ul>
            
            <p>You will receive another email once your account has been approved. This usually takes 24-48 hours.</p>
            
            <p>If you have any questions, please contact us at debate.bangladesh.federation@gmail.com</p>
            
            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
            
            <p style="text-align: center; color: #6b7280; font-style: italic;">
                "The Art of Argumentation"
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Bangladesh Debate Federation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>