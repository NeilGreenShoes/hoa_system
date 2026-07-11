<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Inter', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">

                    <tr>
                        <td align="center" style="background-color: #1A5FFF; padding: 30px 20px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 700; letter-spacing: 0.5px;">HOA PORTAL</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px; text-align: center;">
                            <h2 style="margin: 0 0 16px 0; color: #111827; font-size: 22px; font-weight: 600;">Account Verification</h2>
                            <p style="margin: 0 0 24px 0; color: #4b5563; font-size: 15px; line-height: 1.6;">
                                Hello <strong>{{ $firstname }}</strong>,<br>
                                Thank you for joining your Homeowners Association portal. Use the security verification code below to finalize your registration:
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin: 0 auto 24px auto;">
                                <tr>
                                    <td align="center" style="background-color: #f3f4f6; border: 1px dashed #e5e7eb; border-radius: 12px; padding: 16px 40px;">
                                        <span style="font-family: monospace; font-size: 36px; font-weight: 700; color: #1A5FFF; letter-spacing: 6px;">{{ $otpCode }}</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0; color: #6b7280; font-size: 13px;">
                                This temporary code is active for <strong>10 minutes</strong>.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>