<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .invoice {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            border-bottom: 2px solid #007bff;
            margin-bottom: 20px;
            text-align: center;
        }
        .invoice-header h1 {
            color: #007bff;
            margin: 0;
        }
        .invoice-body {
            margin-top: 20px;
        }
        .invoice-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #6c757d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        @media only screen and (max-width: 600px) {
            .invoice {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Cảm ơn bạn đã đặt hàng!</h1>
            <p>Đơn hàng của bạn đã được đặt thành công với mã: <strong>{{ $bill->code }}</strong></p>
        </div>
        <div class="invoice-body">
            <h5>Thông tin đơn hàng:</h5>
            <ul style="list-style-type: none; padding: 0;">
                <li><strong>Họ và tên:</strong> {{ $bill->full_name }}</li>
                <li><strong>Số điện thoại:</strong> {{ $bill->phone_number }}</li>
                <li><strong>Địa chỉ:</strong> {{ $bill->address }}</li>
                <li><strong>Phương thức thanh toán:</strong> {{ $bill->payment_type}}</li>
                <li><strong>Thành tiền:</strong> {{ number_format($bill->total_price, 0, ',', '.') }} VNĐ</li>
            </ul>
            <h5>Chi tiết sản phẩm:</h5>
            <table>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill->items as $item) 
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->variant->size->name }}</td>
                            <td>{{ $item->variant_quantity }}</td>
                            <td>{{ number_format($item->sale_price, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="invoice-footer">
            <p>Cảm ơn bạn đã mua hàng!</p>
        </div>
    </div>
</body>
</html>