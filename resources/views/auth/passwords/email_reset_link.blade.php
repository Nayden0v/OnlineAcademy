<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Hello, {{ $name }}</h2>
    <p>You have requested a password reset. Please click the following link to reset your password:</p>
    <a href="{{ $resetUrl }}">Reset password</a>
    <p>If you didn't request this password reset, please ignore this email.</p>
</body>
</html>
