<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('resultreservation.css') }}">
    <title>Détails de la Voiture</title>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-details">
            <h2>Détails de la Voiture</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $voiture->marque }} {{ $voiture->modele }}</h5>
                    <p class="card-text"><strong>Couleur:</strong> {{ $voiture->couleur }}</p>
                    <p class="card-text"><strong>Immatriculation:</strong> {{ $voiture->immatriculation }}</p>
                    <p class="card-text"><strong>Carburant:</strong> {{ $voiture->carburant }}</p>
                    <p class="card-text"><strong>Puissance:</strong> {{ $voiture->puissance }} CV</p>
                    <p class="card-text"><strong>Kilométrage:</strong> {{ $voiture->kilometrage }} km</p>
                    <p class="card-text"><strong>Statut:</strong> {{ $voiture->statut }}</p>
                    <p class="card-text"><strong>Prix de la saison:</strong> {{ $price->prix }} MAD</p>
                    
                    <form action="{{ route('payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="dateDepart" value="{{ $dateDepart }}">
                        <input type="hidden" name="dateRetour" value="{{ $dateRetour }}">
                        <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
                        <input type="hidden" name="price_id" value="{{ $price->id }}">
                        <button type="submit" class="btn btn-primary">Réserver</button>
                    </form>
                </div>
            </div>
            <a href="/voitures" class="btn btn-secondary">Retour à la liste des voitures</a>
        </div>
    </div>
</body>

</html>
