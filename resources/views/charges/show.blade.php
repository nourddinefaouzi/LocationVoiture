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
            <h1>Charge</h1>
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
                <div class="reservation-id">Charge {{$charge->id}}</div>
            </div>
            <div class="detail-group">
                <h3>Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Montant:</span>
                    <span class="detail-value">{{$charge->montant}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value">{{$charge->date}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Motif:</span>
                    <span class="detail-value">{{$charge->motif}}</span>
                </div>
            </div>
            <div class="detail-group">
                <h3>Voiture</h3>
                <div class="detail-row">
                    <span class="detail-label">marque:</span>
                    <span class="detail-value">{{$charge->voiture->marque}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">modele:</span>
                    <span class="detail-value">{{$charge->voiture->modele}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">couleur:</span>
                    <span class="detail-value">{{$charge->voiture->couleur}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">immatriculation:</span>
                    <span class="detail-value">{{$charge->voiture->immatriculation}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">carburant:</span>
                    <span class="detail-value">{{$charge->voiture->carburant}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">puissance:</span>
                    <span class="detail-value">{{$charge->voiture->puissance}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">kilometrage:</span>
                    <span class="detail-value">{{$charge->voiture->kilometrage}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">statut:</span>
                    <span class="detail-value">{{$charge->voiture->statut}}</span>
                </div>
            </div>
            
            <div class="actions">
                <button class="action-btn edit-btn"><a href={{route('charges.edit', $charge->id)}}>Edit charge</a></button>
                <form action={{route('charges.destroy', $charge->id)}} method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn" type="submit">Delete charge</button>
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
            <h2>Gestion des charges</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>nom</th>
                        <th>Debut de la charge</th>
                        <th>Fin de la charge</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$charge->nom}}</td>
                        <td>{{$charge->debutcharge}}</td>
                        <td>{{$charge->fincharge}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/charges" class="btn-list">Liste des charges</a>
        </div>
    </div>
</body>

</html> --}}