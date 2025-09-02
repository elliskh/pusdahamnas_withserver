<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            font-size: 20px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            letter-spacing: 4px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo {{ $name }},</h2>
        <p>Registrasi akun Anda berhasil. Silakan lakukan verifikasi terlebih dahulu agar akun dapat digunakan.</p>
        
        <div class="code">{{ $code }}</div>
        
        <p>Terima kasih,<br><strong>Tim Pusdahamnas</strong></p>

        <div class="footer">
            Email ini dibuat otomatis, mohon jangan dibalas.
        </div>
    </div>
</body>
</html>
