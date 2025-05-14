<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <h2>Login</h2>
        
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p style="color: red;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
