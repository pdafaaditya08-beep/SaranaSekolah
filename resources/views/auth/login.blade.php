<!DOCTYPE html>

<html>
<head>
    <title>Login Pengaduan Sarana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

```
    .login-box {
        background: white;
        padding: 30px;
        width: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        font-size: 14px;
    }

    input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #0056b3;
    }

    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }
</style>
```

</head>
<body>

<div class="login-box">
    <h2>Login</h2>

```
@if($errors->any())
    <div class="error">{{ $errors->first() }}</div>
@endif

<form method="POST" action="/login">
    @csrf

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>
```

</div>

</body>
</html>
