<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href={{asset('admin.css')}}>
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
            <h1>Bilan</h1>
            <div class="user-info">
                <span>{{session('admin_name')}}</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalCharges = 0;
                    $totalReservations = 0;
                @endphp
                
                @foreach($bilan as $item)
                    <tr style="background-color: {{ $item['type'] == 'charge' ? '#f8d7da' : '#d4edda' }}">
                        <td>{{ $item['date']->format('Y-m-d') }}</td>
                        <td>{{ $item['type'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['type'] == 'charge' ? '-' : '' }}{{ number_format(abs($item['montant']), 2) }} MAD</td>
                    </tr>
    
                    @if($item['type'] == 'charge')
                        @php $totalCharges += abs($item['montant']); @endphp
                    @else
                        @php $totalReservations += $item['montant']; @endphp
                    @endif
                @endforeach
    
                @php
                    $totalBalance = $totalReservations - $totalCharges;
                @endphp
    
                <tr>
                    <td colspan="3">Total</td>
                    <td style="background-color: {{ $totalBalance < 0 ? '#f8d7da' : '#d4edda' }}">
                        {{ number_format($totalBalance, 2) }} MAD
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
