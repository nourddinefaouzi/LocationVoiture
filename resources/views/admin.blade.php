<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href={{asset('admin.css')}}>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            {{-- <img src="refine-logo.png" alt="Refine Logo"> --}}
            Location Voiture
        </div>
        <div class="menu-item active">📊 Dashboard</div>
        <div class="menu-item">📝 Voitures</div>
        <div class="menu-item">📝 Clients</div>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Reservations</h1>
            <div class="user-info">
                <span>{{user->name}}</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
        {{-- <button class="create-btn">+ Create</button> --}}
        <table>
            <thead>
                <tr>
                    <th>Debut</th>
                    <th>Fin</th>
                    <th>Statut</th>
                    <th>Client</th>
                    <th>Prix</th>
                    <th>Show</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->debutReservation}}</td>
                        <td>{{$reservation->finReservation}}</td>
                        <td><span class="status {{$reservation->statut}}">{{$reservation->statut}}</span></td>
                        <td>{{$reservation->client_id}}</td>
                        <td>{{$reservation->price_id}}</td>
                        <td class="actions">
                            <button>👁️</button>
                        </td>
                        <td class="actions">
                            <button>✏️</button>
                        </td>
                        <td class="actions">
                            <button>🗑️</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>