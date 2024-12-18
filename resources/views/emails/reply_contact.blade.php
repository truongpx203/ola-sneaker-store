<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phản hồi từ Admin</title>
    <style>
/* General Styles */
body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
            color: #333333;
        }

        .container {
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #f1f1f1;
        }

        .invoice-header h1 {
            font-size: 36px;
            color: #007bff;
            font-weight: 600;
            margin: 0;
            letter-spacing: 1px;
        }

        .invoice-body {
            margin-top: 30px;
        }

        .invoice-body p {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        .invoice-body p strong {
            color: #1a73e8;
            font-weight: 600;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #8c8c8c;
            font-weight: 400;
        }

        /* Responsive Design */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .invoice-header h1 {
                font-size: 28px;
            }

            .invoice-body p {
                font-size: 14px;
            }

            .invoice-footer {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice-header">
            <h1>Phản hồi từ Admin</h1>
        </div>

        <div class="invoice-body">
            <p>Xin chào <strong>{{ $contact->user->full_name }}</strong>,</p> <!-- Hiển thị tên người dùng -->
            
            <p>Email của bạn: <strong>{{ $contact->user->email }}</strong></p> <!-- Hiển thị email người dùng -->
            
            <p>Cảm ơn bạn đã liên hệ với chúng tôi! Chúng tôi đã nhận được thông tin của bạn và đây là phản hồi từ đội ngũ hỗ trợ:</p>
            
            <p><strong>Tiêu đề:</strong> {{ $contact->subject }}</p> <!-- Tiêu đề của yêu cầu -->
            
            <p><strong>Nội dung liên hệ:</strong> </p>
            <blockquote style="border-left: 3px solid #1a73e8; padding-left: 15px; margin: 20px 0;">
                {{ $contact->message }}
            </blockquote> <!-- Nội dung liên hệ của người dùng -->
            
            <p><strong>Phản hồi của chúng tôi:</strong></p>
            <p>{{ $replyMessage }}</p> <!-- Phản hồi từ admin -->
        </div>

        <div class="invoice-footer">
            <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn. Nếu có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với chúng tôi.</p>
            <p>Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi!</p>
        </div>
    </div>
</body>

</html>
