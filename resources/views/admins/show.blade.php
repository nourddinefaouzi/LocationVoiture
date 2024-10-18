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
            <h1>Admin</h1>
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
                <div class="reservation-id">Admin {{$user->id}}</div>
                <span class="status on-the-way">actif</span>
            </div>
            <div class="detail-group">
                <h3>Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{$user->name}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{$user->email}}</span>
                </div>
            </div>
        
            <div class="actions">
                <button class="action-btn edit-btn"><a href={{route('admins.edit', $user->id)}}>Edit Admin</a></button>
                <form action={{route('admins.destroy', $user->id)}} method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn" type="submit">Delete Admin</button>
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
            <h2>Gestion des clients</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>password</th>
                        <th>role</th>
                        <th>role</th>
                        <th>Tel</th>
                        <th>Permis</th>
                        <th>Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$client->user->name}}</td>
                        <td>{{$client->user->email}}</td>
                        <td>{{$client->user->prix}}</td>
                        <td>{{$client->user->password}}</td>
                        <td>{{$client->user->role}}</td>
                        <td>{{$client->Tel}}</td>
                        <td>{{$client->Permis}}</td>
                        <td>{{$client->Adresse}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/clients" class="btn-list">Liste des clients</a>
        </div>
    </div>
</body>

</html> --}}