<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('resultvoiture.css') }}">
    <title>Gestion des Voitures</title>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des voitures</h2>
            @if($voitures->isNotEmpty())
                <div class="row">
                    @foreach($voitures as $voiture)
                        <div class="col-md-4 mb-4"> <!-- 3 cards in a row -->
                            <div class="card small-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $voiture->marque }} {{ $voiture->modele }}</h5>
                                    <p class="card-text"><strong>Couleur:</strong> {{ $voiture->couleur }}</p>
                                    <p class="card-text"><strong>Immatriculation:</strong> {{ $voiture->immatriculation }}</p>
                                    <p class="card-text"><strong>Carburant:</strong> {{ $voiture->carburant }}</p>
                                    <p class="card-text"><strong>Puissance:</strong> {{ $voiture->puissance }} CV</p>
                                    <p class="card-text"><strong>Kilométrage:</strong> {{ $voiture->kilometrage }} km</p>
                                    <p class="card-text"><strong>Prix de base:</strong> {{ $voiture->prix }} MAD</p>
                                    <p class="card-text"><strong>Statut:</strong> {{ $voiture->statut }}</p>
                                    <p class="card-text"><strong>Prix de la saison:</strong> {{ $voiture->prices->first()->prix }} MAD</p>
                                    <form action="{{ route('reservations.result') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="dateDepart" value="{{ $dateDepart }}">
                                        <input type="hidden" name="dateRetour" value="{{ $dateRetour }}">
                                        <input type="hidden" name="voiture_id" value="{{ $voiture->id }}">
                                        <input type="hidden" name="price_id" value="{{ $voiture->prices->first()->id }}">
                                        <button type="submit" class="btn btn-primary">Reserver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No matching price found.</p>
            @endif
            
            <a href="/voitures" class="btn btn-secondary">Liste des voitures</a>
        </div>
    </div>
</body>

</html>
