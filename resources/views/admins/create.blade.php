<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
 --}}    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter un client</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des clients</h2>
            {{-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}

            <form action="{{ route('admins.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" id="role" name="role" value="admin" disabled>
                </div>
                <div class="form-buttons">
                    <a href="{{ route('admins.index') }}" class="btn cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
