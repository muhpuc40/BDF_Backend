<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for contacting Bangladesh Debate Federation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #059669; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 8px 8px; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px; }
        .highlight { background: #d1fae5; padding: 15px; border-radius: 6px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bangladesh Debate Federation</h1>
        </div>
        
        <div class="content">
            <h2>Dear {{ $name }},</h2>
            
            <p>Thank you for contacting the Bangladesh Debate Federation. We have received your message and appreciate you taking the time to reach out to us.</p>
            
            <div class="highlight">
                <p><strong>Subject:</strong> {{ $subject }}</p>
                <p><strong>Received:</strong> {{ $timestamp }}</p>
            </div>
            
            <p>Our team will review your inquiry and respond to you within 24-48 hours. We strive to address all inquiries promptly and provide you with the information or assistance you need.</p>
            
            <p>In the meantime, you can visit our website for the latest updates on events, news, and announcements.</p>
            
            <p>Best regards,<br>
            <strong>Bangladesh Debate Federation Team</strong></p>
        </div>
        
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} Bangladesh Debate Federation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>