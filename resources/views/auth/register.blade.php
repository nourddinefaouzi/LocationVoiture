<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
 --}}
    <link rel="stylesheet" href="{{ asset('register.css') }}">
    <title>Ajouter une voiture</title>
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
            <div>{{ $message }}</div>
            @enderror

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

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation">

            <label>Tel</label>
            <input type="text" name="Tel" value="{{ old('Tel') }}">
            @error('Tel')
            <div>{{ $message }}</div>
            @enderror

            <label>Permis</label>
            <input type="text" name="Permis" value="{{ old('Permis') }}">
            @error('Permis')
            <div>{{ $message }}</div>
            @enderror

            <label>Adresse</label>
            <input type="text" name="Adresse" value="{{ old('Adresse') }}">
            @error('Adresse')
            <div>{{ $message }}</div>
            @enderror

            <label for="cin">National ID</label>
            <input type="text" id="cin" name="cin">
            @error('cin')
            <div>{{ $message }}</div>
            @enderror
            
            <label for="passport">Passport</label>
            <input type="text" id="passport" name="passport">
            @error('passport')
            <div>{{ $message }}</div>
            @enderror

            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>