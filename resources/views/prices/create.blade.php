<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter un prix</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des prices</h2>
            <form action="{{ route('prices.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="voiture_id">Marque, modele, immatriculation</label>
                    <select name="voiture_id">
                        @foreach($voitures as $voiture)
                            <option value="{{ $voiture->id }}" id="voiture_id" >{{ $voiture->marque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="saison_id">Saison</label>
                    <select name="saison_id">
                        @foreach($saisons as $saison)
                            <option value="{{ $saison->id }}" id="saison_id" >{{ $saison->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="minJoursReservation">Min Jours Reservation</label>
                    <input type="number" id="minJoursReservation" name="minJoursReservation">
                </div>
                <div class="form-group">
                    <label for="maxJoursReservation">Max Jours Reservation</label>
                    <input type="number" id="maxJoursReservation" name="maxJoursReservation">
                </div>
                <div class="form-group">
                    <label for="prix">prix</label>
                    <input type="text" id="prix" name="prix">
                </div>
                <div class="form-buttons">
                    <a href="{{ route('prices.index') }}" class="btn cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
