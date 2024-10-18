<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="{{ asset('create.css') }}">--}}    
    <link rel="stylesheet" href="{{ asset('edit.css') }}">
    {{--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Modifier une voiture</title>
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
            
            <div class="uploaded-image" id="uploaded-image-container">
                @if (isset($voiture->photos) && $voiture->photos)
                    @foreach ($voiture->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->path) }}" alt="Image de la voiture" width="200">
                    @endforeach
                @else
                    <h3>No Image Uploaded</h3>
                @endif
            </div>

            <form action="{{ route('voitures.update', $voiture->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="images">Choose Images:</label>
                    <input type="file" name="images[]" id="images" multiple>
                </div>

                <div class="form-group">
                    <label for="marque">Marque</label>
                    <input type="text" id="marque" name="marque" value="{{ $voiture->marque }}" placeholder="Entrez la marque">
                </div>

                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <input type="text" id="modele" name="modele" value="{{ $voiture->modele }}" placeholder="Entrez le modèle">
                </div>

                <div class="form-group">
                    <label for="couleur">Couleur</label>
                    <input type="text" id="couleur" name="couleur" value="{{ $voiture->couleur }}" placeholder="Entrez la couleur">
                </div>

                <div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" id="immatriculation" name="immatriculation" value="{{ $voiture->immatriculation }}" placeholder="Entrez l'immatriculation">
                </div>

                <div class="form-group">
                    <label for="carburant">Carburant</label>
                    <input type="text" id="carburant" name="carburant" value="{{ $voiture->carburant }}" placeholder="Entrez le type de carburant">
                </div>

                <div class="form-group">
                    <label for="puissance">Puissance</label>
                    <input type="text" id="puissance" name="puissance" value="{{ $voiture->puissance }}" placeholder="Entrez la puissance">
                </div>

                <div class="form-group">
                    <label for="kilometrage">Kilométrage</label>
                    <input type="text" id="kilometrage" name="kilometrage" value="{{ $voiture->kilometrage }}" placeholder="Entrez le kilométrage">
                </div>

                <div class="form-group">
                    <label for="statut">Statut</label>
                    <input type="text" id="statut" name="statut" value="{{ $voiture->statut }}" placeholder="Entrez le statut">
                </div>

                @foreach($voiture->prices as $index => $price)
                    <div class="form-container">
                        <div class=" price-title">
                            <h3>Prix num {{$index + 1}}</h3>
                            <button type="button" class="btn-delete" onclick="deletePrice({{ $price->id }})">X</button>
                        </div>
                        
                        <div class="form-group">
                            <label for="saison_id">Saison</label>
                            <select name="prices[{{$index}}][saison_id]">
                                @foreach($saisons as $saison)
                                    <option
                                        @if ( $saison->id == $price->saison_id ) 
                                            selected
                                        @endif
                                    value="{{ $saison->id }}" id="saison_id">{{ $saison->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" hidden name="prices[{{$index}}][id]" value="{{ $price->id }}">
                        <div class="form-group">
                            <label for="minJoursReservation">Min Jours Reservation</label>
                            <input type="number" name="prices[{{$index}}][minJoursReservation]" value="{{ $price->minJoursReservation }}">
                        </div>
                        <div class="form-group">
                            <label for="maxJoursReservation">Max Jours Reservation</label>
                            <input type="number" name="prices[{{$index}}][maxJoursReservation]" value="{{ $price->maxJoursReservation }}">
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix par jour</label>
                            <input type="text" name="prices[{{$index}}][prix]" value="{{ $price->prix }}">
                        </div>
                    </div>
                @endforeach

                <div id="formContainer"></div>
                <button id="addFormButton" type="button">Ajouter un prix</button>


                <div class="form-buttons">
                    <a href="{{ route('voitures.index') }}" class="btn-cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const container = document.getElementById('uploaded-image-container');

            // Clear previous previews
            container.innerHTML = '';

            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Create an img element for each uploaded image
                        const imgPreview = document.createElement('img');
                        imgPreview.src = e.target.result;
                        imgPreview.width = 200; // Set a width for preview images
                        container.appendChild(imgPreview);
                    }
                    reader.readAsDataURL(file); // Read the image file as a data URL
                });
            }
        });

        let priceIndex = 0;
        let priceCount = {{count($voiture->prices)}};
        document.getElementById('addFormButton').addEventListener('click', function() {
            const formDiv = document.createElement('div');
            formDiv.classList.add('car-management', 'form-container');
            
            formDiv.innerHTML = `
                <div>
                    <div class="price-title">
                        <h3>Prix num ${priceCount + 1}</h3>
                        <button type="button" class="btn reset">X</button>
                    </div>
                    <input type="number" hidden name="prices[${priceIndex}][id]" value="0">
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
            priceCount++;
            formDiv.querySelector('.reset').addEventListener('click', function() {
                formDiv.remove();
            });

        });

        // JavaScript function to handle delete via AJAX
        function deletePrice(priceId) {
            if (confirm('Are you sure you want to delete this price?')) {
                $.ajax({
                    url: `{{ url('/prices') }}/${priceId}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        //console.log('Delete response:', response); // Log response for debugging
                        //alert('Price deleted successfully');
                        location.reload(); // Reload the page
                    },
                    error: function(xhr) {
                        //console.error('Error deleting price:', xhr); // Log error for debugging
                        alert('Error deleting price');
                    }
                });
            }
        }

    </script>
</body>
</html>
