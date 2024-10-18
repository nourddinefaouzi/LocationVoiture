<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
 --}}    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter une voiture</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des voitures</h2>
            {{-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}

            <form action="{{ route('voitures.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="marque">Marque</label>
                    <input type="text" id="marque" name="marque" placeholder="Entrez la marque">
                </div>

                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <input type="text" id="modele" name="modele" placeholder="Entrez le modèle">
                </div>

                <div class="form-group">
                    <label for="couleur">Couleur</label>
                    <input type="text" id="couleur" name="couleur" placeholder="Entrez la couleur">
                </div>

                <div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" id="immatriculation" name="immatriculation" placeholder="Entrez l'immatriculation">
                </div>

                <div class="form-group">
                    <label for="carburant">Carburant</label>
                    <input type="text" id="carburant" name="carburant" placeholder="Entrez le type de carburant">
                </div>

                <div class="form-group">
                    <label for="puissance">Puissance</label>
                    <input type="text" id="puissance" name="puissance" placeholder="Entrez la puissance">
                </div>

                <div class="form-group">
                    <label for="kilometrage">Kilométrage</label>
                    <input type="text" id="kilometrage" name="kilometrage" placeholder="Entrez le kilométrage">
                </div>

                <div class="form-group">
                    <label for="prix">Prix de base</label>
                    <input type="text" id="prix" name="prix" placeholder="Entrez le prix">
                </div>

                <div class="form-group">
                    <label for="statut">Statut</label>
                    <input type="text" id="statut" name="statut" placeholder="Entrez le statut">
                </div>

                <div class="form-group">
                    <label for="images">Choose Images:</label>
                    <input type="file" name="images[]" id="images" multiple>
                </div>

                <h2>Management des prix</h2>
                <div id="formContainer"></div>
                <button id="addFormButton" type="button">Ajouter un prix</button>

                <div class="form-buttons">
                    <a href="{{ route('voitures.index') }}" class="btn cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Ajouter voiture</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let priceIndex = 0;
        document.getElementById('addFormButton').addEventListener('click', function() {
            const formDiv = document.createElement('div');
            formDiv.classList.add('car-management', 'form-container');
            
            formDiv.innerHTML = `
                <div>
                    <div class="form-buttons price-title">
                        <h3>Prix num ${priceIndex+1}</h3>
                        <button type="button" class="btn reset">X</button>
                    </div>
                    <div class="form-group">
                        <label for="saison_id">Saison</label>
                        <select name="prices[${priceIndex}][saison_id]">
                            @foreach($saisons as $saison)
                                <option value="{{ $saison->id }}" id="saison_id" >{{ $saison->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minJoursReservation">Min Jours Reservation</label>
                        <input type="number" name="prices[${priceIndex}][minJoursReservation]">
                    </div>
                    <div class="form-group">
                        <label for="maxJoursReservation">Max Jours Reservation</label>
                        <input type="number" name="prices[${priceIndex}][maxJoursReservation]">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix par jour</label>
                        <input type="text" name="prices[${priceIndex}][prix]">
                    </div>
                    
                </div>

            `;

            document.getElementById('formContainer').appendChild(formDiv);
            priceIndex++;
            formDiv.querySelector('.reset').addEventListener('click', function() {
                formDiv.remove();
            });

        });
    </script>
</body>
</html>
