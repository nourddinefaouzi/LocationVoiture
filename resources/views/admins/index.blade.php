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
            <h1>Admins</h1>
            <div class="user-info">
                <span>{{session('admin_name')}}</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
        <button class="create-btn"><a class="ajout-btn" href={{route('admins.create')}}>Ajouter un admin</a></button>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if(!$user->client)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="actions">
                                <a href={{ route('admins.show', $user->id) }}>👁️</a>
                            </td>
                            <td class="actions">
                                <button class="btn-update"><a href={{route('admins.edit', $user->id)}}>✏️</a></button>
                            </td>
                            <td class="actions">
                                <form action={{route('admins.destroy', $user->id)}} method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete" type="submit">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endif
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
            <h2>Gestion des client</h2>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <a class="ajout-btn" href='/'>Home</a>
            <a class="ajout-btn" href={{route('clients.create')}}>Ajouter un client</a>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>password</th>
                        <th>Tel</th>
                        <th>Permis</th>
                        <th>Adresse</th>
                        <th>Show</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>
                            @foreach($users as $user)
                                @if($client->user_id == $user->id)
                                    {{$user->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($users as $user)
                                @if($client->user_id == $user->id)
                                    {{$user->email}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($users as $user)
                                @if($client->user_id == $user->id)
                                    {{$user->password}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$client->Tel}}</td>
                        <td>{{$client->Permis}}</td>
                        <td>{{$client->Adresse}}</td>
                        <td><button class="btn-show"><a href={{ route('clients.show', $client->id) }}>X</a></button>
                        </td>
                        <td><button class="btn-update"><a href={{route('clients.edit', $client->id)}}>X</a></button>
                        </td>
                        <td>
                            <form action={{route('clients.destroy', $client->id)}} method="POST">
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