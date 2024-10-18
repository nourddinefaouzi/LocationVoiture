<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('edit.css') }}">
    <title>Modifier le prix</title>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des prix</h2>
            <form action={{route('prices.update', $price->id)}} method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="minJoursReservation">Min Jours Reservation</label>
                    <input type="number" id="minJoursReservation" name="minJoursReservation" value="{{$price->minJoursReservation}}">
                </div>
                <div class="form-group">
                    <label for="maxJoursReservation">Max Jours Reservation</label>
                    <input type="number" id="maxJoursReservation" name="maxJoursReservation" value="{{$price->maxJoursReservation}}">
                </div>
                <div class="form-group">
                    <label for="prix">prix</label>
                    <input type="text" id="prix" name="prix" value="{{$price->prix}}">
                </div>
                <div class="form-group">
                    <label for="voiture_id">voiture</label>
                    <select name="voiture_id">
                        @foreach($voitures as $voiture)
                            <option
                                @if ( $voiture->id == $price->voiture_id ) 
                                    selected
                                @endif
                            value="{{ $voiture->id }}" id="voiture_id">{{ $voiture->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="saison_id">saison</label>
                    <select name="saison_id">
                        @foreach($saisons as $saison)
                            <option
                                @if ( $saison->id == $price->saison_id ) 
                                    selected
                                @endif
                            value="{{ $saison->id }}" id="saison_id">{{ $saison->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-buttons">
                    <a href="{{ route('prices.index') }}" class="btn-cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>