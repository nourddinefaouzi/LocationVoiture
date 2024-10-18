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
                    <li><a href="#">Home Page</a></li>
                    <li><a href="#">Rent Car</a></li>
                    <li><a href="#">Buy Car</a></li>
                    <li><a href="#">News</a></li>
                </ul>
            </nav>
            <div>
                <a href="/login" class="sign-in">Log in</a>
                <a href="/register" class="sign-in">register</a>
            </div>
        </header>
        <main>
            <form class="search-form">
                <div class="form-group">
                    <label for="dateDepart">Date de départ</label>
                    <input type="date" id="dateDepart">
                </div>
            
                <div class="form-group">
                    <label for="dateRetour">Date de retour</label>
                    <input type="date" id="dateRetour">
                </div>
            
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" placeholder="Marrakech" disabled>
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
                            <div class="rating">★★★★★ <span>5.0 (2,438 Reviews)</span></div>
                            <div class="location">Main Karen district, Nairobi city</div>
                            <div class="features">
                                <span>5 seats</span>
                                <span>{{$voiture->kilometrage}}</span>
                                <span>18" Auto</span>
                            </div>
                            <div class="price-action">
                                <span class="price">${{$voiture->prix}}<small>/day</small></span>
                                <button class="rent-btn"><a href={{ route('showcar', $voiture->id) }}>Voir plus</a></button>
                            </div>
                        </div>
                    @endforeach
                        
                </div>
            </div>
        </section>

    </div>
</body>
</html>