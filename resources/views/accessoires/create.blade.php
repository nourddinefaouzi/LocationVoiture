<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
 --}}    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter un accessoire</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des accessoires</h2>
            {{-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}
            @if (isset($accessoire) && $accessoire->image)
                <div class="uploaded-image">
                    <img src="{{ asset('storage/' . $accessoire->image) }}" alt="Image de l'accessoire" id="image-preview" width="200">
                </div>
            @else
                <!-- Image Preview Container -->
                <div class="uploaded-image" id="image-preview-container" style="display:none;">
                    <img id="image-preview" width="200" alt="Image de l'accessoire">
                </div>
            @endif
            <form action="{{ route('accessoires.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="quantite">Quantite</label>
                    <input type="text" id="quantite" name="quantite">
                </div>
                <div class="form-group">
                    <label for="max">Max quantite</label>
                    <input type="max" name="max" id="max">
                </div>
                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="text" id="prix" name="prix">
                </div>
                <div class="form-group">
                    <label for="prixType">Type de paiment</label>
                    <input type="text" id="prixType" name="prixType">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-buttons">
                    <a href="{{ route('accessoires.index') }}" class="btn cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = document.getElementById('image-preview');
                    const imgContainer = document.getElementById('image-preview-container');
    
                    // Show the preview container
                    imgContainer.style.display = 'block';
    
                    // Set the image source to the uploaded file
                    imgPreview.src = e.target.result;
                }
                reader.readAsDataURL(file); // Read the image file as a data URL
            }
        });
    </script>
</body>
</html>
