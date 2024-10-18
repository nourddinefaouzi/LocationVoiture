<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('index.css') }}>
</head>

<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des prix</h2>
            <a class="ajout-btn" href='/'>Home</a>
            <a class="ajout-btn" href={{route('prices.create')}}>Ajouter un prix</a>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Min Jours Reservation</th>
                        <th>Max Jours Reservation</th>
                        <th>Prix</th>
                        <th>voiture</th>
                        <th>Show</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prices as $price)
                    <tr>
                        <td>{{$price->minJoursReservation}}</td>
                        <td>{{$price->maxJoursReservation}}</td>
                        <td>{{$price->prix}}</td>
                        <td>{{$price->voiture_id}}</td>
                        <td><button class="btn-show"><a href={{ route('prices.show', $price->id) }}>X</a></button>
                        </td>
                        <td><button class="btn-update"><a href={{route('prices.edit', $price->id)}}>X</a></button>
                        </td>
                        <td>
                            <form action={{route('prices.destroy', $price->id)}} method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit">X</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>