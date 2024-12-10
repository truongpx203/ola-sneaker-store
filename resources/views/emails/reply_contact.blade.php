<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi từ Admin</title>
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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
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
    {{-- 10/12/2024 --}}
    <div class="invoice">
        <div class="invoice-body">
            <h5>Phản hồi từ Admin:</h5>
            <p>Xin chào {{ $contact->name }},</p>
            <p>Chúng tôi đã nhận được liên hệ của bạn và đây là phản hồi từ đội ngũ hỗ trợ:</p>
            <p>{{ $replyMessage }}</p>
        </div>
        <div class="invoice-footer">
            <p>Cảm ơn bạn đã liên hệ với chúng tôi!</p>
        </div>
    </div>
</body>

</html>
