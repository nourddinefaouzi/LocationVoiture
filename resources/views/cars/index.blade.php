<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPCAR - Buy, sell & rent reputable cars</title>
    <link rel="stylesheet" href="{{ asset('all.css') }}">
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
                    <form action={{route('logout')}} method="POST">
                        @csrf
                        <button type="submit" class="log-out">Log out</button>
                    </form>
                @endauth
            </div>
        </header>
        <main>
            <form class="search-form" action={{route('cars.find')}} method="POST">
                @csrf
                <div class="form-group">
                    <label for="dateDepart">Date de départ</label>
                    <input type="date" name="dateDepart"
                    @isset($dateDepart)
                        value="{{$dateDepart->format('Y-m-d')}}"
                    @else
                        value="{{ \Carbon\Carbon::now()->addDays(1)->format('Y-m-d') }}"
                    @endisset>
                </div>
            
                <div class="form-group">
                    <label for="dateRetour">Date de retour</label>
                    <input type="date" name="dateRetour"
                    @isset($dateRetour)
                        value="{{$dateRetour->format('Y-m-d')}}"
                    @else
                        value="{{ \Carbon\Carbon::now()->addDays(4)->format('Y-m-d') }}"
                    @endisset>
                </div>
            
                <div class="form-group">
                    <label for="pickUp">Pick Up</label>
                    <input type="text" name="pickUp"
                    @if(session()->has('pickUp'))
                        value="{{ session('pickUp') }}"
                    @else
                        value="Marrakech"
                    @endif>
                </div>

                <div class="form-group">
                    <label for="dropOff">Drop Off</label>
                    <input type="text" name="dropOff"
                    @if(session()->has('dropOff'))
                        value="{{ session('dropOff') }}"
                    @else
                        value="Marrakech"
                    @endif>
                </div>
            
                <button type="submit">Search</button>
            </form>
        </main>
        
        <section class="car-listings">
            <div class="listing-category">
                <div class="car-grid">
                    
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
                                <span class="price">{{$voiture->prices->first()->prix}} MAD<small>/day</small></span>
                                <form action="{{ route('cars.show', $voiture->id) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="price" value="{{ $voiture->prices->first()->prix }}">
                                    <button type="submit" class="rent-btn">Voir plus</button>
                                </form>                            
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