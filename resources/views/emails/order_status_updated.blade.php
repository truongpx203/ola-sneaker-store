<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật trạng thái đơn hàng</title>
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
            color: #007bff;
        }
    </style>
</head>

<body>
    @php
        $statusMapping = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'in_delivery' => 'Đang giao',
            'delivered' => 'Giao hàng thành công',
            'failed' => 'Giao hàng thất bại',
            'canceled' => 'Đã hủy',
            'completed' => 'Hoàn thành',
        ];
    @endphp
    <div class="notification">
        <h1>Cập nhật trạng thái đơn hàng</h1>
        <p>Xin chào {{ $bill->full_name }},</p>
        <p>Trạng thái đơn hàng của bạn với mã: <strong>{{ $bill->code }}</strong> đã được cập nhật
            thành:<strong>{{ $statusMapping[$bill->bill_status] }}</strong>.</p>
        <p>Thời gian thay đổi trạng thái: <strong>{{ $atDatetime->format('d/m/Y H:i') }}</strong></p>
        @if ($bill->bill_status === 'canceled')
            <p>Rất tiếc, đơn hàng của bạn đã bị hủy. Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
            <p>Lý do hủy đơn: <strong>{{ $note }}</strong></p>
        @elseif ($bill->bill_status === 'failed')
            <p>Rất tiếc, đơn hàng của bạn đã giao thất bại. Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
            @if ($note)
            <p>Lý do giao hàng thất bại: <strong>{{ $note }}</strong></p>
            @endif
        @else
            <p>Cảm ơn bạn đã tin tưởng và mua hàng của chúng tôi!</p>
        @endif
    </div>
</body>

</html>
