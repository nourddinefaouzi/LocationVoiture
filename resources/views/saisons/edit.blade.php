<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('edit.css') }}">
    <title>Modifier la saison</title>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des saisons</h2>
            <form action={{route('saisons.update', $saison->id)}} method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ $saison->nom }}">
                </div>
                <div class="form-group">
                    <label for="debutSaison">Debut de la Saison</label>
                    <input type="text" id="debutSaison" name="debutSaison" value="{{ $saison->debutSaison }}">
                </div>
                <div class="form-group">
                    <label for="finSaison">Fin de la saison</label>
                    <input type="text" id="finSaison" name="finSaison" value="{{ $saison->finSaison }}">
                </div>
                <div class="form-buttons">
                    <a href="{{ route('saisons.index') }}" class="btn-cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn-submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>