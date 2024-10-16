<!DOCTYPE html>
<html>
<head>
    <title>Xác Minh Địa Chỉ Email</title>
</head>
<body>
    <h1>Xin Chào {{ $user->full_name }}</h1>
    <p>Vui lòng xác minh địa chỉ email của bạn bằng cách nhấp vào liên kết dưới đây:</p>
    <a href="{{ route('verify.account', $user->email)}}">
        Xác Minh Email
    </a>
    <p>Cảm ơn bạn!</p>
</body>
</html>