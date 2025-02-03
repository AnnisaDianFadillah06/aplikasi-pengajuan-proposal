<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }
        h1 {
            font-size: 28px;
            color: #4CAF50;
            text-align: center;
        }
        p {
            margin: 10px 0;
            font-size: 16px;
        }
        .highlight {
            color: #d9534f;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer p {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Notifikasi Review</h1>

        <p>Terdapat LPJ yang menunggu review Anda.</p>

        <p><strong>Asal ormawa LPJ:</strong> {{ $data_email['judul'] }}</p>

        <p>Batas waktu review adalah 3 hari dari hari ini, yaitu tanggal <strong>{{ \Carbon\Carbon::now()->addDays(3)->format('d M Y') }}</strong>.</p>

        <p>Silakan login untuk melakukan review.</p>
        <div class="footer">
            <p>Catatan: Email ini dikirim secara otomatis. Harap tidak membalas langsung ke email ini.</p>
        </div>
        <p>Regards,</p>
        <p><strong>Ormawa Kemahasiswaan</strong></p> 
    </div>
</body>
</html>
