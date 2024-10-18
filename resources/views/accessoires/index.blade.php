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
            <h1>Accessoires</h1>
            <div class="user-info">
                <span>{{session('admin_name')}}</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
        <button class="create-btn"><a class="ajout-btn" href={{route('accessoires.create')}}>Ajouter un accessoire</a></button>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Quantite</th>
                    <th>Max</th>
                    <th>Prix</th>
                    <th>Type de paiment</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($accessoires as $accessoire)
                    <tr>
                        <td><img style="width: 30px" src={{Storage::url('accessoires/'.$accessoire->image)}}></td>
                        <td>{{$accessoire->nom}}</td>
                        <td>{{$accessoire->description}}</td>
                        <td>{{$accessoire->quantite}}</td>
                        <td>{{$accessoire->max}}</td>
                        <td>{{$accessoire->prix}}</td>
                        <td>{{$accessoire->prixType}}</td>
                        <td class="actions">
                            <a href={{ route('accessoires.show', $accessoire->id) }}>👁️</a>
                        </td>
                        <td class="actions">
                            <button class="btn-update"><a href={{route('accessoires.edit', $accessoire->id)}}>✏️</a></button>
                        </td>
                        <td class="actions">
                            <form action={{route('accessoires.destroy', $accessoire->id)}} method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" type="submit">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>





{{-- <!DOCTYPE html>
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
            <h2>Gestion des accessoires</h2>
            <a class="ajout-btn" href='/'>Home</a>
            <a class="ajout-btn" href={{route('accessoires.create')}}>Ajouter une accessoire</a>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>nom</th>
                        <th>debutaccessoire</th>
                        <th>finaccessoire</th>
                        <th>Show</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessoires as $accessoire)
                    <tr>
                        <td>{{$accessoire->nom}}</td>
                        <td>{{$accessoire->debutaccessoire}}</td>
                        <td>{{$accessoire->finaccessoire}}</td>
                        <td><button class="btn-show"><a href={{ route('accessoires.show', $accessoire->id) }}>X</a></button>
                        </td>
                        <td><button class="btn-update"><a href={{route('accessoires.edit', $accessoire->id)}}>X</a></button>
                        </td>
                        <td>
                            <form action={{route('accessoires.destroy', $accessoire->id)}} method="POST">
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

</html> --}}