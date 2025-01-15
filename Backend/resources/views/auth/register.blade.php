<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Registrar-se</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

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
                <label for="password_confirmation">Confirmar Senha:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div>
                <button type="submit">Registrar</button>
            </div>
        </form>

        <div>
            <p>Já tem uma conta? <a href="{{ route('login') }}">Faça login aqui</a></p>
        </div>
    </div>
</body>
</html>
