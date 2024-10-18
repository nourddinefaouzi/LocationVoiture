<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('showres.css')}}>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            {{-- <img src="refine-logo.png" alt="Refine Logo"> --}}
            Location Voiture
        </div>
        <div class="menu-item">🎫 <a href="/reservations">Reservations</a></div>
        <div class="menu-item">🚗 <a href="/voitures">Voitures</a></div>
        <div class="menu-item">👥 <a href="/clients">Clients</a></div>
        <div class="menu-item">👨‍✈️ <a href="/admins">Admins</a></div>
        <div class="menu-item">📆 <a href="/saisons">Saisons</a></div>
        <div class="menu-item">🛠️ <a href="/accessoires">Accessoires</a></div>
        <div class="menu-item">🧾 <a href="/charges">Charges</a></div>
        <div class="menu-item">📊 <a href="/bilan">Bilan</a></div>
        <div class="menu-item">📅 <a href="/calendrier">Calendrier</a></div>

    </div>
    <div class="main-content">
        <div class="header">
            <h1>accessoire</h1>
            <div class="user-info">
                <span>{{session('admin_name')}}</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
       
        <div class="reservation-details">
            <div class="reservation-header">
                <div class="reservation-id">Accessoire {{$accessoire->id}}</div>
            </div>
            <div class="detail-group">
                <div class="detail-row">
                    <td><img style="width: 200px" src={{Storage::url($accessoire->image)}}></td>
                </div>
                <h3>Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Nom:</span>
                    <span class="detail-value">{{$accessoire->nom}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Description:</span>
                    <span class="detail-value">{{$accessoire->description}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Quantite:</span>
                    <span class="detail-value">{{$accessoire->quantite}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Max quantite:</span>
                    <span class="detail-value">{{$accessoire->max}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Prix:</span>
                    <span class="detail-value">{{$accessoire->prix}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Type de paiment:</span>
                    <span class="detail-value">{{$accessoire->prixType}}</span>
                </div>
            </div>
            @foreach($reservations as $reservation)
                <div class="detail-group">
                    <h3>Reservation {{$reservation->id}}</h3>
                    <div class="detail-row">
                        <span class="detail-label">Debut:</span>
                        <span class="detail-value">{{$reservation->debutReservation}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Fin:</span>
                        <span class="detail-value">{{$reservation->finReservation}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Statut:</span>
                        <span class="detail-value">{{$reservation->statut}}</span>
                    </div>
                </div>
            @endforeach
            
            <div class="actions">
                <button class="action-btn edit-btn"><a href={{route('accessoires.edit', $accessoire->id)}}>Edit accessoire</a></button>
                <form action={{route('accessoires.destroy', $accessoire->id)}} method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn" type="submit">Delete accessoire</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>





{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('show.css') }}>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des accessoires</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>nom</th>
                        <th>Debut de la accessoire</th>
                        <th>Fin de la accessoire</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$accessoire->nom}}</td>
                        <td>{{$accessoire->debutaccessoire}}</td>
                        <td>{{$accessoire->finaccessoire}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/accessoires" class="btn-list">Liste des accessoires</a>
        </div>
    </div>
</body>

</html> --}}