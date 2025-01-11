<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 24px;
            color: #444;
        }
        p {
            margin: 10px 0;
        }
        .highlight {
            color: #d9534f;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>{{ $data_email['subject'] }}</h1>
        <p>Halo,</p>
        <p>Kode verifikasi Anda adalah: <span class="highlight">{{ $data_email['verification_code'] }}</span></p>
        <p>Gunakan kode ini untuk melanjutkan proses verifikasi. Kode ini berlaku selama <span class="highlight">10 menit</span>.</p>
        <p>Salam,</p>
        <p><strong>{{ $data_email['sender_name'] }}</strong></p>
        <div class="footer">
            <p>Catatan: Email ini dikirim secara otomatis. Harap tidak membalas langsung ke email ini.</p>
        </div>
    </div>
</body>
</html>
