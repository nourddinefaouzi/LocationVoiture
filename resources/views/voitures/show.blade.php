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
            <h1>Voiture</h1>
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
                <div class="reservation-id">Voiture {{$voiture->id}}</div>
            </div>
            <div class="detail-group">
                <h3>Information</h3>
                <div class="detail-row">
                    <span class="detail-label">marque:</span>
                    <span class="detail-value">{{$voiture->marque}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">modele:</span>
                    <span class="detail-value">{{$voiture->modele}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">couleur:</span>
                    <span class="detail-value">{{$voiture->couleur}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">immatriculation:</span>
                    <span class="detail-value">{{$voiture->immatriculation}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">carburant:</span>
                    <span class="detail-value">{{$voiture->carburant}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">puissance:</span>
                    <span class="detail-value">{{$voiture->puissance}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">kilometrage:</span>
                    <span class="detail-value">{{$voiture->kilometrage}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">statut:</span>
                    <span class="detail-value">{{$voiture->statut}}</span>
                </div>
            </div>
            <div class="detail-group">
                <h3>Prix</h3>
                <div style="display: flex; flex-direction: wrap">
                    @foreach($voiture->prices as $price)
                        <div style="border: 0px solid black; margin-right: 50px; border-radius: 10px; padding: 10px; background-color: rgb(222, 222, 222)">
                            <div class="detail-row">
                                <span class="detail-label">Saison:</span>
                                <span class="detail-value">{{$price->saison->nom}}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Min Jours de Reservation:</span>
                                <span class="detail-value">{{$price->minJoursReservation}}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Max Jours de Reservation:</span>
                                <span class="detail-value">{{$price->maxJoursReservation}}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Prix:</span>
                                <span class="detail-value">{{$price->prix}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="actions">
                <button class="action-btn edit-btn"><a href={{route('voitures.edit', $voiture->id)}}>Edit Voiture</a></button>
                <form action={{route('voitures.destroy', $voiture->id)}} method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn" type="submit">Delete Voiture</button>
                </form>
                <button class="action-btn edit-btn"><a href={{ route('bilan.show', $voiture->id) }}>Bilan de la voiture</a></button>
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
            <h2>Gestion des voitures</h2>
                @foreach($voiture->photos as $photo)
                    <img src={{Storage::url($photo->path)}} alt={{$photo->path}}>
                @endforeach
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Couleur</th>
                        <th>Immatriculation</th>
                        <th>Carburant</th>
                        <th>Puissance</th>
                        <th>Kilométrage</th>
                        <th>voiture</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$voiture->marque}}</td>
                        <td>{{$voiture->modele}}</td>
                        <td>{{$voiture->couleur}}</td>
                        <td>{{$voiture->immatriculation}}</td>
                        <td>{{$voiture->carburant}}</td>
                        <td>{{$voiture->puissance}}</td>
                        <td>{{$voiture->kilometrage}}</td>
                        <td>{{$voiture->voiture}}</td>
                        <td>{{$voiture->statut}}</td>
                    </tr>
                </tbody>
            </table>
            <h2>List des voiture</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Min Jours Reservation</th>
                        <th>Max Jours Reservation</th>
                        <th>voiture</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($voiture->prices as $price)
                        <tr>
                            <td>{{$price->minJoursReservation}}</td>
                            <td>{{$price->maxJoursReservation}}</td>
                            <td>{{$price->voiture}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="/voitures" class="btn-list">Liste des voitures</a>
        </div>
    </div>
</body>
</html> --}}