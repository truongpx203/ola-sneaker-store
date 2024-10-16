<!DOCTYPE html>
<html>
<head>
    <title>Quên mật khẩu</title>
</head>
<body>
    <h1>Xin Chào đấng {{ $user->full_name }}</h1>
    <p>Bạn quên mật khẩu rồi à ?</p>
    <a href="{{ route('account.reset_password', $token)}}">
        Hãy click vào đây để tạo mật khẩu mới
    </a>
</body>
</html>