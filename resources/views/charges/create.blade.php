<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter une charge</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des charges</h2>
            <form action="{{ route('charges.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="text" id="montant" name="montant">
                </div>
                <div class="form-group">
                    <label for="date">date</label>
                    <input type="date" id="date" name="date">
                </div>
                <div class="form-group">
                    <label for="motif">motif</label>
                    <input type="text" id="motif" name="motif">
                </div>
                <div class="form-group">
                    <label for="voiture">Voiture:</label>
                    <select name="voiture_id" id="voiture" required>
                        <option value="" disabled selected>Choisir une voiture</option>
                        @foreach($voitures as $voiture)
                            <option value="{{ $voiture->id }}">
                                {{ $voiture->id }} - {{ $voiture->marque }} - {{ $voiture->modele }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-buttons">
                    <a href="{{ route('charges.index') }}" class="btn cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
