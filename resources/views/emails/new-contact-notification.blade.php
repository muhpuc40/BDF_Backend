<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission - {{ $contactEmail->subject }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc2626; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 8px 8px; }
        .message-details { background: #fef3c7; padding: 20px; border-radius: 6px; margin: 20px 0; }
        .btn { display: inline-block; background: #059669; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
        </div>
        
        <div class="content">
            <p><strong>Attention:</strong> A new contact form submission has been received.</p>
            
            <div class="message-details">
                <p><strong>From:</strong> {{ $contactEmail->name }} &lt;{{ $contactEmail->email }}&gt;</p>
                <p><strong>Phone:</strong> {{ $contactEmail->phone ?? 'Not provided' }}</p>
                <p><strong>Subject:</strong> {{ $contactEmail->subject }}</p>
                <p><strong>Message:</strong></p>
                <p>{!! nl2br(e($contactEmail->message)) !!}</p>
                <p><strong>Received:</strong> {{ $timestamp }}</p>
                <p><strong>IP Address:</strong> {{ $contactEmail->ip_address }}</p>
            </div>
            
            <p>To view and respond to this message, please visit the admin dashboard:</p>
            
            <p>
                <a href="{{ url('/emails/' . $contactEmail->id) }}" class="btn">
                    View Message in Dashboard
                </a>
            </p>
        </div>
    </div>
</body>
</html>