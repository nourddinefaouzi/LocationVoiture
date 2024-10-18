<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPCAR - Buy, sell & rent reputable cars</title>
    <link rel="stylesheet" href="{{ asset('welcome.css') }}">
    <style>
        .reservations-container {
            margin-top: 40px;
        }
        .reservation-category {
            margin-bottom: 40px;
        }
        .reservation-category h2 {
            font-size: 24px;
            color: #433878;
            margin-bottom: 20px;
            border-bottom: 2px solid #7E60BF;
            padding-bottom: 10px;
        }
        .reservation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .reservation-card {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .reservation-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #433878;
        }
        .reservation-details {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .reservation-status {
            font-weight: bold;
            margin-top: 10px;
        }
        .status-upcoming {
            color: #4CAF50;
        }
        .status-current {
            color: #2196F3;
        }
        .status-past {
            color: #9E9E9E;
        }
        .reservation-actions {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }
        .reservation-actions button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .view-btn {
            background-color: #433878;
            color: #ffffff;
        }
        .view-btn:hover {
            background-color: #7E60BF;
        }
        .cancel-btn {
            background-color: #d9534f;
            color: #ffffff;
        }
        .cancel-btn:hover {
            background-color: #c9302c;
        }
        .car-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .no-photo {
            width: 100%;
            height: 200px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px 8px 0 0;
            color: #666;
        }
    </style>
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
        
        <div class="reservations-container">
            <div class="reservation-category">
                <h2>Upcoming Bookings</h2>
                <div class="reservation-grid">
                    @foreach ($upcomingBookings as $booking)
                        <div class="reservation-card">
                            @if($booking->voiture->photos->isNotEmpty())
                                <img src="{{ Storage::url($booking->voiture->photos[1]->path) }}" alt="{{ $booking->voiture->marque . ' ' . $booking->voiture->modele }}" class="car-photo">
                            @else
                                <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available" class="car-photo">
                            @endif 
                            <h3>{{ $booking->voiture->marque . ' ' . $booking->voiture->modele }}</h3>
                            <div class="reservation-details">
                                <p>Start Date: {{ \Carbon\Carbon::parse($booking->debutReservation)->format('M d, Y') }}</p>
                                <p>End Date: {{ \Carbon\Carbon::parse($booking->finReservation)->format('M d, Y') }}</p>
                                <p>Total Price: {{ $booking->prixVoiture }} MAD</p>
                            </div>
                            <div class="reservation-status status-upcoming">Upcoming</div>
                            <div class="reservation-actions">
                                {{-- <a href="{{ route('reservations.show', $booking->id) }}" class="view-btn">View Details</a> --}}
                                <form action="{{ route('myrescancel', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="cancel-btn" onclick="return confirm('Are you sure you want to cancel this reservation?');">Cancel</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        

            <div class="reservation-category">
                <h2>Current Bookings</h2>
                <div class="reservation-grid">
                    @foreach ($currentBookings as $booking)
                    <div class="reservation-card">
                        @if($booking->voiture->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $booking->voiture->photos->first()->path) }}" alt="{{ $booking->voiture->marque . ' ' . $booking->voiture->modele }}" class="car-photo">
                        @else
                            <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available" class="car-photo">
                        @endif
                        <h3>{{ $booking->voiture->marque . ' ' . $booking->voiture->modele }}</h3>
                        <div class="reservation-details">
                            <p>Start Date: {{ \Carbon\Carbon::parse($booking->debutReservation)->format('M d, Y') }}</p>
                            <p>End Date: {{ \Carbon\Carbon::parse($booking->finReservation)->format('M d, Y') }}</p>
                            <p>Total Price: {{ $booking->prixVoiture }} MAD</p>
                        </div>
                        <div class="reservation-status status-current">Active</div>
                        <div class="reservation-actions">
                            {{-- <a href="{{ route('reservations.show', $booking->id) }}" class="view-btn">View Details</a> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="reservation-category">
                <h2>Past Bookings</h2>
                <div class="reservation-grid">
                    @foreach ($pastBookings as $booking)
                    <div class="reservation-card">
                        @if($booking->voiture->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $booking->voiture->photos->first()->path) }}" alt="{{ $booking->voiture->marque . ' ' . $booking->voiture->modele }}" class="car-photo">
                        @else
                            <img src="{{ Storage::url('photos/car.jpg') }}" alt="No image available" class="car-photo">
                        @endif
                        <h3>{{ $booking->voiture->marque . ' ' . $booking->voiture->modele }}</h3>
                        <div class="reservation-details">
                            <p>Start Date: {{ \Carbon\Carbon::parse($booking->debutReservation)->format('M d, Y') }}</p>
                            <p>End Date: {{ \Carbon\Carbon::parse($booking->finReservation)->format('M d, Y') }}</p>
                            <p>Total Price: {{ $booking->prixVoiture }} MAD</p>
                        </div>
                        <div class="reservation-status status-past">Completed</div>
                        <div class="reservation-actions">
                            {{-- <a href="{{ route('reservations.show', $booking->id) }}" class="view-btn">View Details</a> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
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
    
</body>
</html>