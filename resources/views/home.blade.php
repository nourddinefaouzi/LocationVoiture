<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('home.css') }}">
    <title>Location Voiture</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="navigation">
            <h2>Hello {{$client->user->name}}</h2>
            @auth
                <form action={{route('logout')}} method="POST">
                    @csrf
                    <button type="submit" class="nav-button">Log out</button>
                </form>
            @else   
                <a href="{{ route('register') }}" class="nav-link-log">Register</a>
                <a href="{{ route('login') }}" class="nav-link-log">Log in</a>
            @endauth
            <a href="{{ route('voitures.index') }}" class="nav-link">Gestion des voitures</a>
            <a href="{{ route('saisons.index') }}" class="nav-link">Gestion des saisons</a>
            <a href="{{ route('prices.index') }}" class="nav-link">Gestion des prix</a>
            <a href="{{ route('clients.index') }}" class="nav-link">Gestion des clients</a>
            <a href="{{ route('reservations.index') }}" class="nav-link">Gestion des reservations</a>
        </div>
    </div>
</body>
</html>
