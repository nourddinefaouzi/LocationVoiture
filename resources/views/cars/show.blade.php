<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAZDA CX-5 2021 Listing</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('showcar.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">TOPCAR</div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href={{ route('cars.index') }}>Cars</a></li>
                    @auth
                        <li><a href={{ route('myres') }}>Mes Reservations</a></li>
                    @endauth
                    <li><a href="/about">About us</a></li>
                    <li><a href="/contact">Contact us</a></li>
                </ul>
            </nav>
            <div>
                @guest
                    <a href="/login" class="sign-in">Log in</a>
                    <a href="/register" class="sign-in">Register</a>
                @endguest
                @auth
                    <form action={{ route('logout') }} method="POST">
                        @csrf
                        <button type="submit" class="log-out">Log out</button>
                    </form>
                @endauth
            </div>
        </header>

        <div class="image-gallery">
            <div class="main-image">
                @if($voiture->photos->isNotEmpty())
                    <img src="{{ Storage::url($voiture->photos[0]->path) }}" alt="{{ $voiture->marque . ' ' . $voiture->modele }}">
                @else
                    <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available">
                @endif 
            </div>
            
            <div class="thumbnail">
                @if($voiture->photos->isNotEmpty())
                    <img src="{{ Storage::url($voiture->photos[1]->path) }}" alt="{{ $voiture->marque . ' ' . $voiture->modele }}">
                @else
                    <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available">
                @endif 
            </div>
            <div class="thumbnail">
                @if($voiture->photos->isNotEmpty())
                    <img src="{{ Storage::url($voiture->photos[2]->path) }}" alt="{{ $voiture->marque . ' ' . $voiture->modele }}">
                @else
                    <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available">
                @endif 
            </div>
        </div>

        <div class="car-info">
            <h1 class="car-title">{{ $voiture->marque . ' ' . $voiture->modele }}</h1>
            <div class="location">Marrakech, Morocco</div>
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🚗</div>
                    <div>5 seats</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">⚙️</div>
                    <div>Auto gearbox</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">⛽</div>
                    <div>Gasoline</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">📏</div>
                    <div>{{$voiture->kilometrage}} km</div>
                </div>
            </div>
            <div class="price-contact">
                <div class="price">{{$price}} MAD<small>/day</small></div>
            </div>
            <div class="description">
                <h2>Description</h2>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tristique mauris nisi eget 
                semper. Nulla nulla sem, varius ut ante vitae, luctus eleifend nisi.
            </div>
            
            <div class="accessories">
                <h2>Options supplémentaires</h2>
                <div class="options-grid">
                    @foreach($accessoires as $accessoire)
                        <div class="option-card" data-prix-jour="{{$accessoire->prixJour}}" data-prix-reservation="{{$accessoire->prixReservation}}">
                            <div class="option-info">
                                <img src="{{ Storage::url('accessoires/'.$accessoire->image) }}" alt="{{$accessoire->nom}}" class="accessoire-image">
                                <div class="accessoire-details">
                                    <div class="accessoire-name">{{$accessoire->nom}}</div>
                                    <div class="accessoire-price">{{$accessoire->prix}} MAD</div>
                                    <input type="hidden" name="prix" class="accessoire-price-value" value="{{$accessoire->prix}}">
                                    <input type="hidden" name="type" class="accessoire-price-type" value="{{$accessoire->prixType}}">
                                </div>
                            </div>
                            <select class="add-button" name="accessoires[{{ $accessoire->id }}][quantity]">
                                @for ($i = 0; $i <= $accessoire->max; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h2>Second Driver</h2>
        
                <!-- Toggle button -->
                <button id="toggle-second-driver" class="toggle-btn">Add Second Driver</button>

                <!-- Second Driver Inputs Section -->
                <div id="second-driver-section" class="second-driver-section">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="second_driver[name]">
                    </div>
                
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="second_driver[email]">
                    </div>
                
                    <div class="form-group">
                        <label for="Tel">Tel</label>
                        <input type="tel" id="Tel" name="second_driver[tel]">
                    </div>
                
                    <div class="form-group">
                        <label for="Permis">Permis</label>
                        <input type="text" id="Permis" name="second_driver[permis]">
                    </div>
                    
                    <div class="form-group">
                        <label for="Adresse">Adresse</label>
                        <input type="text" id="Adresse" name="second_driver[adresse]">
                    </div>
                
                    <div class="form-group">
                        <label for="cin">National ID</label>
                        <input type="text" id="cin" name="second_driver[cin]">
                    </div>
                
                    <div class="form-group">
                        <label for="passport">Passport</label>
                        <input type="text" id="passport" name="second_driver[passport]">
                    </div>
                </div>

            </div>

            <div class="price-contact">
                <div class="price">
                    <span id="base-price">Prix de voiture: {{$price}}</span> MAD<small>/jour</small>
                </div>
                <div class="accessoires-price">
                    <span id="accessoires-price">Prix des accessoires: 0</span> MAD
                </div>
                <div class="total-price price">
                    <span id="total-price">Prix Total: {{$price}}</span> MAD<small>/jour</small>
                </div>
                <form action="{{ route('payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_price" id="hidden-total-price" value="{{$price}}">
                    <input type="hidden" name="accessoires_selection" id="hidden-accessoires-selection" value="">
                    <input type="hidden" name="second_driver_info" id="hidden-second-driver-info" value="">
                    <button type="submit" class="contact-btn">Reserver</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <h2>TOPCAR</h2>
                <p>Website to buy, sell, and rent new and used cars with famous brands such as Bentley, Mercedes, Audi, Porsche, Honda...</p>
                <div class="social-icons">
                    <a href="#" aria-label="Instagram">&#xf16d;</a>
                    <a href="#" aria-label="Facebook">&#xf09a;</a>
                    <a href="#" aria-label="Twitter">&#xf099;</a>
                    <a href="#" aria-label="YouTube">&#xf167;</a>
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-section">
                    <h4>Carvago</h4>
                    <ul>
                        <li><a href="#">Buy</a></li>
                        <li><a href="#">Reviews</a></li>
                        <li><a href="#">Site map</a></li>
                        <li><a href="#">How it works</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Delivery</a></li>
                        <li><a href="#">CarAudit</a></li>
                        <li><a href="#">Warranty</a></li>
                        <li><a href="#">Financing</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Terms of use</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Topcar 2023. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function updateTotalPrice() {
            const prixVoiture = {{$price}};
            const accessoiresTotal = calculateAccessoiresTotal();
            
            document.getElementById('base-price').textContent = `Prix de voiture: ${prixVoiture}`;
            document.getElementById('accessoires-price').textContent = `Prix des accessoires: ${accessoiresTotal}`;
            document.getElementById('total-price').textContent = `Prix Total: ${prixVoiture + accessoiresTotal}`;
            
            document.getElementById('hidden-total-price').value = prixVoiture + accessoiresTotal;
        }
    
        function calculateAccessoiresTotal() {
            let total = 0;
            const accessoires = document.querySelectorAll('.option-card');
    
            accessoires.forEach(accessoire => {
                const quantitySelect = accessoire.querySelector('.add-button');
                const pricingInput = accessoire.querySelector('.accessoire-price-value');
                const pricingTypeInput = accessoire.querySelector('.accessoire-price-type');
    
                const quantity = parseInt(quantitySelect.value);
                const prix = parseFloat(pricingInput.value);
                const pricingType = pricingTypeInput.value;
    
                if (quantity > 0) {
                    if (pricingType === 'day') {
                        const days = {{$dureeReservation}};
                        total += prix * days * quantity;
                    } else if (pricingType === 'reservation') {
                        total += prix * quantity;
                    }
                }
            });
    
            updateHiddenAccessoryInput();
            return total;
        }
    
        function updateHiddenAccessoryInput() {
            const accessoiresData = [];
            const accessoires = document.querySelectorAll('.option-card');
    
            accessoires.forEach(accessoire => {
                const id = accessoire.querySelector('.add-button').name.match(/\d+/)[0];
                const quantity = accessoire.querySelector('.add-button').value;
    
                if (quantity > 0) {
                    accessoiresData.push({
                        id: id,
                        quantity: quantity,
                    });
                }
            });
    
            document.getElementById('hidden-accessoires-selection').value = JSON.stringify(accessoiresData);
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            const accessoires = document.querySelectorAll('.option-card .add-button');
            accessoires.forEach(accessoire => {
                accessoire.addEventListener('change', updateTotalPrice);
            });
    
            updateTotalPrice();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggle-second-driver');
            const secondDriverSection = document.getElementById('second-driver-section');
            const hiddenSecondDriverInfo = document.getElementById('hidden-second-driver-info');

            toggleButton.addEventListener('click', function() {
                if (secondDriverSection.style.display === 'none' || secondDriverSection.style.display === '') {
                    secondDriverSection.style.display = 'block';
                    toggleButton.textContent = 'Remove Second Driver';
                    toggleButton.classList.add('delete');
                } else {
                    secondDriverSection.style.display = 'none';
                    toggleButton.textContent = 'Add Second Driver';
                    toggleButton.classList.remove('delete');
                }
                updateSecondDriverInfo();
            });

            // Update second driver info on input change
            secondDriverSection.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', updateSecondDriverInfo);
            });

            function updateSecondDriverInfo() {
                const secondDriverInfo = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    tel: document.getElementById('Tel').value,
                    permis: document.getElementById('Permis').value,
                    adresse: document.getElementById('Adresse').value,
                    cin: document.getElementById('cin').value,
                    passport: document.getElementById('passport').value
                };
                hiddenSecondDriverInfo.value = JSON.stringify(secondDriverInfo);
            }
        });

    </script>
    
</body>
</html>
