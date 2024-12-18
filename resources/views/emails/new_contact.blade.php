<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo liên hệ mới</title>
    <style>
                /* General Styles */
                body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
            color: #4a4a4a;
        }

        .container {
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 35px;
            border-bottom: 3px solid #f2f2f2;
        }

        .invoice-header h1 {
            font-size: 40px;
            color: #1a73e8;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .invoice-body {
            margin-top: 30px;
        }

        .invoice-body h5 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .invoice-body ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .invoice-body li {
            padding: 18px 0;
            border-bottom: 1px solid #f1f1f1;
            font-size: 16px;
            line-height: 1.6;
        }

        .invoice-body li:last-child {
            border-bottom: none;
        }

        .invoice-body li strong {
            color: #1a73e8;
            font-weight: 600;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 50px;
            font-size: 15px;
            color: #8c8c8c;
            font-weight: 400;
        }

        /* Button Style - White */
        .cta-button {
            display: inline-block;
            background-color: #ffffff;
            color: #1a73e8;
            padding: 15px 25px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            border: 2px solid #1a73e8;
            box-shadow: 0 10px 25px rgba(26, 115, 232, 0.1);
            transition: all 0.3s ease;
            margin-top: 30px;
        }

        .cta-button:hover {
            background-color: #1a73e8;
            color: #ffffff;
            border-color: #1a73e8;
        }

        /* Responsive Design */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .invoice-header h1 {
                font-size: 32px;
            }

            .invoice-body h5 {
                font-size: 22px;
            }

            .cta-button {
                font-size: 16px;
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
    {{-- 10/12/2024 --}}
    <div class="container">
        <div class="invoice-header">
            <h1>Thông Báo Liên Hệ Mới</h1>
        </div>

        <div class="invoice-body">
            <h5>Thông tin liên hệ:</h5>
            <ul>
                <li><strong>Họ và tên:</strong> {{ $contact->user->full_name }}</li>
                <li><strong>Email:</strong> {{ $contact->user->email }}</li>
                <li><strong>Tiêu đề:</strong> {{ $contact->subject }}</li>
                <li><strong>Nội dung:</strong> {{ $contact->message }}</li>
            </ul>

            <a href="{{ route('contacts.index') }}" class="cta-button">Xem chi tiết liên hệ</a>
        </div>

        <div class="invoice-footer">
            <p>Cảm ơn bạn đã liên hệ với chúng tôi! Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.</p>
        </div>
    </div>
</body>

</html>
