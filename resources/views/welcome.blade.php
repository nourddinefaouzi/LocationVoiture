<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPCAR - Buy, sell & rent reputable cars</title>
    <link rel="stylesheet" href="{{ asset('welcome.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">TOPCAR</div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href={{route('cars.index')}}>Cars</a></li>
                    @auth
                        <li><a href={{route('myres')}}>Mes Reservations</a></li>
                    @endauth    
                    <li><a href="/about">About us</a></li>
                    <li><a href="/contact">Contact us</a></li>
                </ul>
            </nav>
            <div>
                @guest
                    <a href="/login" class="sign-in">Log in</a>
                    <a href="/register" class="sign-in">register</a>
                @endguest
                @auth
                    @if(Auth::user()->role === 'client')
                        <form action={{route('logout')}} method="POST">
                            @csrf
                            <button type="submit" class="log-out">Log out</button>
                        </form>
                        @else
                            <a href="/login" class="sign-in">Log in</a>
                            <a href="/register" class="sign-in">register</a>
                    @endif
                @endauth
            </div>
        </header>
        <main class="main-content">
            <div class="text-content">
                <h1>Buy, sell & rent <span>reputable cars</span></h1>
                <p>Buy and sell reputable cars. Renting a car is easy and fast with Topcar</p>
                <div class="stats">
                    <div class="stat">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Car brands</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">10k+</div>
                        <div class="stat-label">Clients</div>
                    </div>
                </div>
                <form class="search-form" action={{route('cars.find')}} method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="dateDepart">Date de départ</label>
                        <input type="date" name="dateDepart">
                    </div>
                
                    <div class="form-group">
                        <label for="dateRetour">Date de retour</label>
                        <input type="date" name="dateRetour">
                    </div>
                
                    <div class="form-group">
                        <label for="pickUp">Pick Up</label>
                        <input type="text" name="pickUp" value="Marrakech">
                    </div>

                    <div class="form-group">
                        <label for="dropOff">Drop Off</label>
                        <input type="text" name="dropOff" value="Marrakech">
                    </div>
                
                    <button type="submit">Search</button>
                </form>
                
            </div>
            <div class="car-image">
                <img src="Luxury_Car.png" alt="Luxury Car">
            </div>
        </main>
        <section class="car-listings">
            <div class="listing-category">
                <h2>RENT CAR <a href={{route('cars.index')}} class="see-all">See all →</a></h2>
                <div class="car-row">
                    @foreach ($voitures as $voiture)
                        <div class="car-card">
                            @if($voiture->photos->isNotEmpty())
                                <img src="{{ Storage::url($voiture->photos[0]->path) }}" alt="{{ $voiture->marque . ' ' . $voiture->modele }}">
                            @else
                                <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available">
                            @endif                            
                            <h3>{{ $voiture->marque . ' ' . $voiture->modele }}</h3>
                            <div class="location">Marrakech, Morocco</div>
                            <div class="features">
                                <span>5 seats</span>
                                <span>{{$voiture->kilometrage}}</span>
                                <span>18" Auto</span>
                            </div>
                            <div class="price-action">
                                {{-- <span class="price">200 MAD<small>/day</small></span> --}}                            
                            </div>
                        </div>
                    @endforeach
                </div>
                              
            </div>
        </section>
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
    
</body>
</html>