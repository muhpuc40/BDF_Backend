<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Update</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { 
            background: {{ $status === 'active' ? 'linear-gradient(135deg, #059669 0%, #10b981 100%)' : 'linear-gradient(135deg, #dc2626 0%, #ef4444 100%)' }}; 
            color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; 
        }
        .content { background: #fff; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 10px 10px; }
        .status-badge { 
            display: inline-block; 
            padding: 8px 16px; 
            background: {{ $status === 'active' ? '#10b981' : '#ef4444' }}; 
            color: white; 
            border-radius: 20px; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bangladesh Debate Federation</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $user->full_name }},</h2>
            
            <p>Your registration status has been updated.</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <span class="status-badge">
                    {{ ucfirst($status) }}
                </span>
            </div>
            
            @if($status === 'active')
                <p><strong>Congratulations!</strong> Your registration has been approved. You can now log in to your account and access all features.</p>
                <p><a href="{{ url('/signin') }}" style="display: inline-block; padding: 12px 24px; background: #059669; color: white; text-decoration: none; border-radius: 5px;">Log In Now</a></p>
            @else
                <p>We regret to inform you that your registration request has been rejected. This may be due to incomplete information or other reasons.</p>
                <p>If you believe this is a mistake, please contact us at debate.bangladesh.federation@gmail.com</p>
            @endif
            
            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
            
            <p style="color: #6b7280;">Updated: {{ $timestamp }}</p>
        </div>
    </div>
</body>
</html>