<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - BeasiswaKu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #FCE4E4; /* Warna TextFieldPink dari aplikasimu */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .card {
            background: white;
            padding: 32px;
            border-radius: 0px; /* Sudut tajam khas brutalist */
            border: 3px solid #D03939; /* Garis tegas */
            box-shadow: 8px 8px 0px #D03939; /* Bayangan tebal / Solid shadow */
            width: 100%;
            max-width: 400px;
        }
        h2 {
            color: #D03939;
            text-align: center;
            margin-top: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        p {
            font-size: 14px;
            color: #555;
            text-align: center;
            margin-bottom: 24px;
        }
        label {
            font-size: 12px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 4px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 2px solid #333;
            background-color: #fff;
            box-sizing: border-box;
            font-size: 14px;
        }
        input:focus {
            outline: none;
            border-color: #D03939;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #D03939;
            color: white;
            border: 2px solid #D03939;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.2s;
        }
        button:hover {
            background: white;
            color: #D03939;
            box-shadow: 4px 4px 0px #D03939;
            transform: translate(-2px, -2px);
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Reset Password</h2>
        <p>Silakan masukkan password baru untuk akunmu.</p>

        <form action="{{ url('/api/reset-password') }}" method="POST">
            
            <input type="hidden" name="token" value="{{ $token }}">
            
            <label>EMAIL</label>
            <input type="email" name="email" value="{{ $email }}" readonly>
            
            <label>PASSWORD BARU</label>
            <input type="password" name="password" required placeholder="Minimal 6 karakter">
            
            <label>KONFIRMASI PASSWORD BARU</label>
            <input type="password" name="password_confirmation" required placeholder="Ketik ulang password baru">
            
            <button type="submit">Simpan Password</button>
        </form>
    </div>

</body>
</html>