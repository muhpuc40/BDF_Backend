<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #e5e7eb; border-top: none; border-radius: 0 0 10px 10px; }
        .info-box { background: #f9fafb; border-left: 4px solid #059669; padding: 15px; margin: 20px 0; }
        .button { display: inline-block; padding: 10px 20px; background: #059669; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New User Registration</h1>
        </div>
        <div class="content">
            <h2>A new user has registered</h2>
            
            <div class="info-box">
                <p><strong>Name:</strong> {{ $user->full_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Institution:</strong> {{ $user->institution }}</p>
                <p><strong>Registered:</strong> {{ $timestamp }}</p>
                <p><strong>Status:</strong> Pending Approval</p>
            </div>
            
            <p>Please log in to the admin panel to review and approve this registration.</p>
            
            <p style="margin-top: 30px;">
                <a href="{{ url('/admin/users') }}" class="button">Go to Admin Panel</a>
            </p>
        </div>
    </div>
</body>
</html>