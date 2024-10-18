<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('search.css') }}>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div>
            <h2>Reserver une voiture</h2>
            <form action="{{ route('voitures.find') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Localisation</label>
                    <input type="text" value="Marrakech" disabled>
                </div>
                <div class="form-group">
                    <label>Date de départ</label>
                    <input type="date" name="dateDepart" required>
                </div>
                <div class="form-group">
                    <label>Date de retour</label>
                    <input type="date" name="dateRetour" required>
                </div>
                <button type="submit">Recherche</button>
            </form> 
        </div>
        <a href="{{ route('voitures.index') }}">Voir toutes les voitures</a>
    </div>
</body>
</html>
