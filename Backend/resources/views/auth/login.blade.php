<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>

        <div>
            <p>Ainda não tem uma conta? <a href="{{ route('register') }}">Registre-se aqui</a></p>
        </div>
    </div>
</body>
</html>
