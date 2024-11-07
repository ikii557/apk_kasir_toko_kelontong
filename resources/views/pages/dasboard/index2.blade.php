<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Toko Kelontong - Welcome</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <!-- Pignose Calendar -->
    <link href="{{asset('assets/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74EBD5, #9FACE6);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .welcome-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .welcome-card .brand-logo img {
            width: 100px;
        }
        .welcome-card h1 {
            color: #333;
            font-size: 24px;
            margin: 20px 0;
        }
        .welcome-card p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .welcome-card .btn-login {
            background-color: #5a67d8;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .welcome-card .btn-login:hover {
            background-color: #434190;
        }
    </style>
</head>
<body>

    <div class="welcome-card bg-dark">
        <div class="brand-logo">
            <img src="{{asset('assets/images/logoo.png')}}" alt="Toko Kelontong Logo">
        </div>
        <h1>Selamat Datang di Toko Kelontong</h1>
        <p>Bergabunglah dengan kami untuk kemudahan transaksi dan kelengkapan informasi barang yang Anda butuhkan.</p>
        <a href="/login" class="btn-login">Masuk Sekarang</a>
    </div>

</body>
</html>
