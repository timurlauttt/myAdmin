<head>
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #777;
            text-align: center
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        a.btn {
            flex: 1;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 0 5px;
            text-align: center;
        }
        a.btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang</h1>
        <p>Silahkan klik Admin jika Anda adalah Admin atau  <br>  silahkan klik Supir jika Anda adalah Supir</p>
        <div class="btn-container">
            <a href="{{ route('admin.login') }}" class="btn">Admin</a>
            <a href="{{ route('customer.login')}}" class="btn"> Supir</a>
        </div>
    </div>
</body>
</html>
