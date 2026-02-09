<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Re: {{ $contactEmail->subject }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #059669; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 8px 8px; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px; }
        .original-message { background: #f3f4f6; padding: 15px; border-left: 4px solid #059669; margin: 20px 0; font-style: italic; }
        .reply-message { background: #d1fae5; padding: 15px; border-radius: 6px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bangladesh Debate Federation</h1>
        </div>
        
        <div class="content">
            <h2>Dear {{ $name }},</h2>
            
            <p>Thank you for your inquiry. Here is our response to your message:</p>
            
            <div class="reply-message">
                <p><strong>Our Response:</strong></p>
                <p>{!! nl2br(e($replyMessage)) !!}</p>
            </div>
            
            <div class="original-message">
                <p><strong>Your Original Message ({{ $contactEmail->created_at->format('F j, Y, g:i a') }}):</strong></p>
                <p>{!! nl2br(e($originalMessage)) !!}</p>
            </div>
            
            <p>If you have any further questions or need additional assistance, please don't hesitate to contact us again.</p>
            
            <p>Best regards,<br>
            <strong>Bangladesh Debate Federation Team</strong></p>
            
            <p><em>Replied on: {{ $repliedAt }}</em></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Bangladesh Debate Federation. All rights reserved.</p>
        </div>
    </div>
</body>
</html>