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
            <h1>Saison</h1>
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
                <div class="reservation-id">Saison {{$saison->id}}</div>
            </div>
            <div class="detail-group">
                <h3>Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Nom:</span>
                    <span class="detail-value">{{$saison->nom}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Debut de la saison:</span>
                    <span class="detail-value">{{$saison->debutSaison}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fin de la saison:</span>
                    <span class="detail-value">{{$saison->finSaison}}</span>
                </div>
            </div>
            
            <div class="actions">
                <button class="action-btn edit-btn"><a href={{route('saisons.edit', $saison->id)}}>Edit Saison</a></button>
                <form action={{route('saisons.destroy', $saison->id)}} method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn" type="submit">Delete Saison</button>
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
            <h2>Gestion des saisons</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>nom</th>
                        <th>Debut de la saison</th>
                        <th>Fin de la saison</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$saison->nom}}</td>
                        <td>{{$saison->debutSaison}}</td>
                        <td>{{$saison->finSaison}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/saisons" class="btn-list">Liste des saisons</a>
        </div>
    </div>
</body>

</html> --}}