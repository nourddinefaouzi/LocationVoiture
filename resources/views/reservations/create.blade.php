<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('create.css') }}">
    <title>Ajouter une reservation</title>

    <script>
        // Fonction pour rediriger avec les nouvelles dates
        function redirectToCreateView() {
            const debutReservation = document.getElementById('debutReservation').value;
            const finReservation = document.getElementById('finReservation').value;

            if (debutReservation && finReservation) {
                window.location.href = `{{ route('reservations.create') }}?dateDepart=${debutReservation}&dateRetour=${finReservation}`;
            }
        }

        // Fonction pour mettre à jour le prix total basé sur la voiture sélectionnée
        function updateTotalPrice() {
            const voitureSelect = document.getElementById('voiture');
            const selectedOption = voitureSelect.options[voitureSelect.selectedIndex];
            const prixVoiture = parseFloat(selectedOption.getAttribute('data-price')) || 0;

            // Set the hidden input value for prixVoiture
            document.getElementById('prixVoiture').value = prixVoiture;

            // Calculate the total price including accessories
            const accessoiresTotal = calculateAccessoiresTotal();

            // Update the total price field
            document.getElementById('total').value = prixVoiture + accessoiresTotal;
        }


        // Fonction pour calculer le total des accessoires sélectionnés
        function calculateAccessoiresTotal() {
            let total = 0;
            const accessoires = document.querySelectorAll('.accessoire-card');

            accessoires.forEach(accessoire => {
                const quantitySelect = accessoire.querySelector('.accessoire-quantity select');
                const pricingInput = accessoire.querySelector('.accessoire-pricing input'); // Correct the pricing selector
                const pricingTypeInput = accessoire.querySelector('.accessoire-pricing-type input'); // Correct the pricing type selector

                const quantity = parseInt(quantitySelect.value);
                const prix = parseFloat(pricingInput.value); // Get the actual price value from the input
                const pricingType = pricingTypeInput.value; // Get the pricing type ('day' or 'reservation')

                if (quantity > 0) {
                    if (pricingType === 'day') {
                        const days = calculateReservationDays();
                        total += prix * days * quantity;
                    } else if (pricingType === 'reservation') {
                        total += prix * quantity;
                    }
                }
            });

            updateHiddenAccessoryInput();  // Update hidden input for accessories

            return total;
        }


        // Fonction pour calculer le nombre de jours de la réservation
        function calculateReservationDays() {
            const debutReservation = new Date(document.getElementById('debutReservation').value);
            const finReservation = new Date(document.getElementById('finReservation').value);
            const timeDiff = finReservation - debutReservation;

            // Convertir la différence de temps en jours
            return Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        }

        // Fonction pour mettre à jour l'input caché des accessoires
        function updateHiddenAccessoryInput() {
            const accessoiresData = [];
            const accessoires = document.querySelectorAll('.accessoire-card');

            accessoires.forEach(accessoire => {
                const id = accessoire.querySelector('.accessoire-quantity select').id.split('_')[1];
                const quantity = accessoire.querySelector('.accessoire-quantity select').value;

                if (quantity > 0) {
                    accessoiresData.push({
                        id: id,
                        quantity: quantity,
                    });
                }
            });

            // Convertir les données des accessoires en JSON
            document.getElementById('accessoiresData').value = JSON.stringify(accessoiresData);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Ajouter l'événement de changement de date
            document.getElementById('debutReservation').addEventListener('change', redirectToCreateView);
            document.getElementById('finReservation').addEventListener('change', redirectToCreateView);

            // Ajouter l'événement de changement de voiture pour mettre à jour le prix total
            document.getElementById('voiture').addEventListener('change', updateTotalPrice);

            // Ajouter des événements sur les accessoires pour recalculer le prix total
            const accessoires = document.querySelectorAll('.accessoire-card select');
            accessoires.forEach(accessoire => {
                accessoire.addEventListener('change', updateTotalPrice);
            });
        });
    </script>

</head>
<body>
    <div class="container">
        <h1>Ajouter une Réservation</h1>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            
            <!-- Début de la réservation -->
            <div class="form-group">
                <label for="debutReservation">Début de la réservation:</label>
                <input type="date" name="debutReservation" id="debutReservation" 
                    value="{{ old('debutReservation', is_a(session('dateDepart'), \Carbon\Carbon::class) ? session('dateDepart')->format('Y-m-d') : session('dateDepart')) }}" 
                    required>
                @error('debutReservation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Fin de la réservation -->
            <div class="form-group">
                <label for="finReservation">Fin de la réservation:</label>
                <input type="date" name="finReservation" id="finReservation" 
                    value="{{ old('finReservation', is_a(session('dateRetour'), \Carbon\Carbon::class) ? session('dateRetour')->format('Y-m-d') : session('dateRetour')) }}" 
                    required>
                @error('finReservation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Pick up -->
            <div class="form-group">
                <label for="pickUp">Pick Up:</label>
                <input type="text" name="pickUp" id="pickUp" value="{{ old('pickUp') }}" required>
                @error('pickUp')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Drop off -->
            <div class="form-group">
                <label for="dropOff">Drop Off:</label>
                <input type="text" name="dropOff" id="dropOff" value="{{ old('dropOff') }}" required>
                @error('dropOff')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Statut de la réservation -->
            <div class="form-group">
                <label for="statut">Status de la réservation:</label>
                <select name="statut" id="statut" required>
                    <option value="" disabled selected>Choisir le status</option>
                    <option value="confirmed" {{ old('statut') == 'confirmed' ? 'selected' : '' }}>confirmed</option>
                    <option value="pending" {{ old('statut') == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="cancelled" {{ old('statut') == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                </select>
                @error('statut')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Client selection -->
            <div class="form-group">
                <label for="client">Client:</label>
                <select name="client_id" id="client" required>
                    <option value="" disabled selected>Choisir un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->user->name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Second driver -->
            <div class="form-group">
                <label for="secondDriver">Second Driver:</label>
                <select name="secondDriver" id="secondDriver">
                    <option value="" disabled selected>Choisir un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('secondDriver') == $client->id ? 'selected' : '' }}>{{ $client->user->name }}</option>
                    @endforeach
                </select>
                @error('secondDriver')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Code Contrat -->
            <div class="form-group">
                <label for="codeContrat">Code Contrat:</label>
                <input type="text" name="codeContrat" id="codeContrat" value="{{ old('codeContrat') }}" required>
                @error('codeContrat')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Voiture selection -->
            <div class="form-group">
                <label for="voiture">Voiture:</label>
                <select name="voiture_id" id="voiture" required>
                    <option value="" disabled selected>Choisir une voiture</option>
                    @foreach($voitures as $voiture)
                        <option value="{{ $voiture->id }}" data-price="{{ $voiture->prices->first()->prix }}" {{ old('voiture_id') == $voiture->id ? 'selected' : '' }}>
                            {{ $voiture->id }} - {{ $voiture->marque }} - {{ $voiture->modele }} - {{ $voiture->prices->first()->prix }} MAD
                        </option>
                    @endforeach
                </select>
                @error('voiture_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Hidden field for car price -->
            <input type="hidden" name="prixVoiture" id="prixVoiture">
        
            <!-- Accessoires selection -->
            <div class="form-group">
                <label>Choisissez des accessoires:</label>
                <div class="accessoires-container">
                    @foreach($accessoires as $accessoire)
                    <div class="accessoire-card">
                        <div class="accessoire-header">
                            
                            <img src="{{ Storage::url('accessoires/'.$accessoire->image) }}" alt="{{ $accessoire->nom }}" class="accessoire-image">
                            <h3>{{ $accessoire->nom }}</h3>
                        </div>
                
                        <div class="accessoire-details">
                            <div class="accessoire-quantity">
                                <label for="quantity_{{ $accessoire->id }}">Quantité:</label>
                                <select name="accessoires[{{ $accessoire->id }}][quantity]" id="quantity_{{ $accessoire->id }}">
                                    @for ($i = 0; $i <= $accessoire->max; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @error("accessoires.{$accessoire->id}.quantity")
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <div class="accessoire-pricing">
                                <label for="prix">Prix:</label>
                                <input type="text" name="prix" id="prix" value="{{$accessoire->prix}} MAD" disabled>
                            </div>
                
                            <div class="accessoire-pricing-type">
                                <input type="hidden" name="type" id="type" value="{{$accessoire->prixType}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        
            <!-- Hidden input to store selected accessories -->
            <input type="hidden" name="accessoiresData" id="accessoiresData" value="[]">
        
            <!-- Prix total -->
            <div class="form-group">
                <label for="total">Prix Total:</label>
                <input type="number" name="total" id="total" required readonly>
                @error('total')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
        
            <div class="form-buttons">
                <a href="{{ route('reservations.index') }}" class="btn cancel">Annuler</a>
                <button type="reset" class="btn reset">Vider</button>
                <button type="submit" class="btn submit">Ajouter</button>
            </div>
        </form>
        
    </div>
</body>
</html>
