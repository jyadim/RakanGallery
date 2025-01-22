<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Hello {{ $name }},</p>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>
    <a href="{{ $verificationLink }}">Verify My Email</a>
    <p>If you did not request this registration, please ignore this email.</p>
</body>
</html>
