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
            <h1>Reservation</h1>
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
                <div class="reservation-id">Reservation {{$reservation->id}}</div>
                <span class="status on-the-way">actif</span>
            </div>
            <div class="detail-group">
                <h3>Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Debut:</span>
                    <span class="detail-value">{{$reservation->debutReservation}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fin:</span>
                    <span class="detail-value">{{$reservation->finReservation}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Statut:</span>
                    <span class="detail-value">{{$reservation->statut}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Code Contrat:</span>
                    <span class="detail-value">{{$reservation->codeContrat}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Prix de la voiture:</span>
                    <span class="detail-value">{{$reservation->prixVoiture}} MAD</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Pick Up:</span>
                    <span class="detail-value">{{$reservation->pickUp}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Drop Off:</span>
                    <span class="detail-value">{{$reservation->dropOff}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total:</span>
                    <span class="detail-value">{{$reservation->total}} MAD</span>
                </div>
            </div>
            <div class="row-detail-group">
                <div class="detail-group">
                    <h3>Client</h3>
                    <div class="detail-row">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value">{{$reservation->client->user->name}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">{{$reservation->client->user->email}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Phone:</span>
                        <span class="detail-value">{{$reservation->client->Tel}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Permis:</span>
                        <span class="detail-value">{{$reservation->client->Permis}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Adresse:</span>
                        <span class="detail-value">{{$reservation->client->Adresse}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">CIN:</span>
                        <span class="detail-value">{{$reservation->client->cin}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Passport:</span>
                        <span class="detail-value">{{$reservation->client->passport}}</span>
                    </div>
                </div>
                <div class="detail-group">
                    <h3>Second Driver</h3>
                    @if(is_null($reservation->secondDriver))
                        <p>Aucun second driver n'est associé à cette réservation.</p>
                    @else
                        <div class="detail-row">
                            <span class="detail-label">Name:</span>
                            <span class="detail-value">{{$secondDriver->user->name}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{$secondDriver->user->email}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value">{{$secondDriver->Tel}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Permis:</span>
                            <span class="detail-value">{{$secondDriver->Permis}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Adresse:</span>
                            <span class="detail-value">{{$secondDriver->Adresse}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">CIN:</span>
                            <span class="detail-value">{{$secondDriver->cin}}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Passport:</span>
                            <span class="detail-value">{{$secondDriver->passport}}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="detail-group">
                <h3>Voiture</h3>
                <div class="detail-row">
                    <span class="detail-label">marque:</span>
                    <span class="detail-value">{{$reservation->voiture->marque}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">modele:</span>
                    <span class="detail-value">{{$reservation->voiture->modele}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">couleur:</span>
                    <span class="detail-value">{{$reservation->voiture->couleur}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">immatriculation:</span>
                    <span class="detail-value">{{$reservation->voiture->immatriculation}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">carburant:</span>
                    <span class="detail-value">{{$reservation->voiture->carburant}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">puissance:</span>
                    <span class="detail-value">{{$reservation->voiture->puissance}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">kilometrage:</span>
                    <span class="detail-value">{{$reservation->voiture->kilometrage}}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">statut:</span>
                    <span class="detail-value">{{$reservation->voiture->statut}}</span>
                </div>
            </div>
            <div class="detail-group">
                <h3>Accessoires</h3>
                @if($accessoires->isEmpty())
                    <p>Aucun accessoire n'est associé à cette réservation.</p>
                @else
                    <div class="accessoire-grid">
                        @foreach($accessoires as $index => $accessoire)
                            <div style="border: 0px solid black; margin-right: 50px; border-radius: 10px; padding: 10px; background-color: rgb(222, 222, 222)">
                                <div class="accessoire-header">
                                    <h4>{{ $accessoire->nom }}</h4>
                                </div>
                                <div class="accessoire-details">
                                    <div class="detail-row">
                                        <span class="detail-label">Quantité:</span>
                                        <span class="detail-value">{{ $accessoire->pivot->quantite }}</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Prix:</span>
                                        <span class="detail-value">{{ $accessoire->prix }} MAD</span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Type de paiment:</span>
                                        <span class="detail-value">par {{$accessoire->prixType}}</span>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Create a new row after every 3 accessories -->
                            @if(($index + 1) % 3 == 0)
                                <div class="clearfix"></div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            
            <div class="actions">
                <button class="action-btn edit-btn">Edit Reservation</button>
                <form action={{route('reservations.destroy', $reservation->id)}} method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="action-btn delete-btn" type="submit">Delete Reservation</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

