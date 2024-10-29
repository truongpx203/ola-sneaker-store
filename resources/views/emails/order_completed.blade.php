<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng đã hoàn thành</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .notification {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745; 
        }
    </style>
</head>
<body>
    <div class="notification">
        <h1>Thông báo hoàn thành đơn hàng</h1>
        <p>Xin chào {{ $bill->full_name }},</p>
        <p>Đơn hàng của bạn với mã: <strong>{{ $bill->code }}</strong> đã được hoàn thành.</p>
        <p>Cảm ơn bạn đã mua hàng và hy vọng bạn hài lòng với sản phẩm của mình!</p>
        <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
    </div>
</body>
</html>