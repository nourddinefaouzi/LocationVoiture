<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('edit.css') }}">
    <title>Modifier la charge</title>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des charges</h2>
            <form action={{route('charges.update', $charge->id)}} method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="text" id="montant" name="montant" value="{{ $charge->montant }}">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{ $charge->date }}">
                </div>
                <div class="form-group">
                    <label for="motif">Motif</label>
                    <input type="text" id="motif" name="motif" value="{{ $charge->motif }}">
                </div>
                <div class="form-group">
                    <label for="voiture">Voiture:</label>
                    <select name="voiture_id" id="voiture" required>
                        @foreach($voitures as $voiture)
                            <option value="{{ $voiture->id }}">
                                {{ $voiture->id }} - {{ $voiture->marque }} - {{ $voiture->modele }}
                                @if($voiture->id === $charge->voiture_id)
                                    selected
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-buttons">
                    <a href="{{ route('charges.index') }}" class="btn-cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn-submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>