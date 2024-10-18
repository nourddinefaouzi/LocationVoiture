<!DOCTYPE html>
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
            <h2>Gestion des prix</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Min Jours Reservation</th>
                        <th>Max Jours Reservation</th>
                        <th>Prix</th>
                        <th>voiture</th>
                        <th>saison</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$price->minJoursReservation}}</td>
                        <td>{{$price->maxJoursReservation}}</td>
                        <td>{{$price->prix}}</td>
                        <td>{{$price->voiture_id}}</td>
                        <td>{{$price->saison_id}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/prices" class="btn-list">Liste des prix</a>
        </div>
    </div>
</body>

</html>