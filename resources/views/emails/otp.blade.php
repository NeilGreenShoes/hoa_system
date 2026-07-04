<!DOCTYPE html>
<html>
<head>
    <title>Login Verification</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div style="max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px;">
        <h2 style="color: #2d3748; margin-bottom: 20px;">Security Verification Code</h2>
        <p>Hello,</p>
        <p>Use the following One-Time Password (OTP) to log into your account:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 4px; padding: 10px 25px; background-color: #edf2f7; border-radius: 6px; color: #2b6cb0;">
                {{ $otp }}
            </span>
        </div>
        
        <p>This code is active for 10 minutes. If you did not request this, you can safely ignore this email.</p>
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">
        <p style="font-size: 12px; color: #718096;">This is an automated security message. Please do not reply.</p>
    </div>
</body>
</html>
