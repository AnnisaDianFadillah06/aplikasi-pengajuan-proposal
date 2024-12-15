<!-- <h1>{{ $data_email['subject'] }}</h1>
<p>Halo,</p>
<p>{{ $data_email['isi'] }}</p>
<p>Salam,</p>
<p>{{ $data_email['sender_name'] }}</p> -->
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
        <h1>Revisi Proposal</h1>
        <p>Halo, <strong>{{ $data_email['username'] }}</strong>,</p>
        <p>Berikut merupakan revisi untuk proposal dengan judul <strong>"{{ $data_email['judul'] }}"</strong>.</p>
        <p>{{ $data_email['isi'] }}</p>
        <p>
            <span class="highlight">Catatan:</span> Perbaiki dan unggah revisi maksimal dalam waktu 
            <span class="highlight">3 hari</span>.
        </p>
        <p>Salam,</p>
        <p><strong>{{ $data_email['sender_name'] }}</strong></p>
        <div class="footer">
            <p>Catatan: Email ini dikirim secara otomatis. Harap tidak membalas langsung ke email ini.</p>
        </div>
    </div>
</body>
</html>
