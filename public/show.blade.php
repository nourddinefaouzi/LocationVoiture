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
                <span>James Sullivan</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
       
        <div class="reservation-details">
            <div class="reservation-header">
                <div class="reservation-id">Order #977771</div>
                <span class="status on-the-way">On the way</span>
            </div>
            <div class="detail-group">
                <h3>Customer Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">Candace Ruth</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">candace.ruth@example.com</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">+1 (555) 123-4567</span>
                </div>
            </div>
            <div class="detail-group">
                <h3>Order Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Store:</span>
                    <span class="detail-value">Mikel Cliffs</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amount:</span>
                    <span class="detail-value">$51.97</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Products:</span>
                    <span class="detail-value">3 items</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Created at:</span>
                    <span class="detail-value">January 08, 2023</span>
                </div>
            </div>
            <div class="actions">
                <button class="action-btn edit-btn">Edit Reservation</button>
                <button class="action-btn delete-btn">Delete Reservation</button>
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
            <h2>Gestion des reservation</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Min Jours Reservation</th>
                        <th>Max Jours Reservation</th>
                        <th>Statut</th>
                        <th>client</th>
                        <th>prix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$reservation->debutReservation}}</td>
                        <td>{{$reservation->finReservation}}</td>
                        <td>{{$reservation->statut}}</td>
                        <td>{{$reservation->client_id}}</td>
                        <td>{{$reservation->price_id}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/reservations" class="btn-list">Liste des reservation</a>
        </div>
    </div>
</body>

</html> --}}