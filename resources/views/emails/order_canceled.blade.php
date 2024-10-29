<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng đã bị hủy</title>
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
            color: #dc3545; 
        }
    </style>
</head>
<body>
    <div class="notification">
        <h1>Thông báo hủy đơn hàng</h1>
        <p>Xin chào {{ $bill->full_name }},</p>
        <p>Đơn hàng của bạn với mã: <strong>{{ $bill->code }}</strong> đã bị hủy.</p>
        <p>Lý do hủy: <strong>{{ $note }}</strong></p>
        <p>Thời gian hủy: <strong>{{ $atDatetime->format('d/m/Y H:i') }}</strong></p>
        <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
    </div>
</body>
</html>