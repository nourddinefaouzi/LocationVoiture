<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter une saison</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des saisons</h2>
            <form action="{{ route('saisons.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Entrez le nom">
                </div>
                <div class="form-group">
                    <label for="debutSaison">Debut de la Saison</label>
                    <input type="date" id="debutSaison" name="debutSaison" placeholder="Entrez le debut de la saison">
                </div>
                <div class="form-group">
                    <label for="finSaison">Fin de la saison</label>
                    <input type="date" id="finSaison" name="finSaison" placeholder="Entrez la fin de la saison">
                </div>
                <div class="form-buttons">
                    <a href="{{ route('saisons.index') }}" class="btn cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
