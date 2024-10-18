<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
 --}}
    <link rel="stylesheet" href="{{ asset('login.css') }}">
    <title>Ajouter une voiture</title>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
            <div>{{ $message }}</div>
            @enderror

            <label>Password</label>
            <input type="password" name="password">
            @error('password')
            <div>{{ $message }}</div>
            @enderror

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>