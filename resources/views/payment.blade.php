<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('payment.css') }}">
    <title>Ajouter une voiture</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>Payment Information</h1>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">Log out</button>
            </form>
        </header>
        
        <section class="info">
            @isset($dateDepart)
                <p><strong>dateDepart :</strong> {{ $dateDepart }}</p>
            @endisset
            @isset($dateRetour)
                <p><strong>dateRetour :</strong> {{ $dateRetour }}</p>
            @endisset
            @isset($pickUp)
                <p><strong>pickUp :</strong> {{ $pickUp }}</p>
            @endisset
            @isset($dropOff)
                <p><strong>dropOff :</strong> {{ $dropOff }}</p>
            @endisset
            @isset($voiture_id)
                <p><strong>Voiture ID:</strong> {{ $voiture_id }}</p>
            @endisset
            @isset($price)
                <p><strong>Price :</strong> {{ $price }} MAD</p>
            @endisset
            @isset($client_id)
                <p><strong>Client ID:</strong> {{ $client_id }}</p>
            @endisset
            @isset($second_driver_info)
                <p><strong>Second driver:</strong></p>
                <p><strong>Name:</strong> {{ $second_driver_info['name'] }}</p>
            @endisset
            @isset($total_price)
                <p><strong>Total price:</strong> {{ $total_price }}</p>
            @endisset
            @isset($accessoires_selection)
                @if(is_array($accessoires_selection) && count($accessoires_selection) > 0)
                    @foreach($accessoires_selection as $accessoire)
                        <p><strong>*********</strong></p>
                        <p><strong>Accessoire ID:</strong> {{ $accessoire['id'] }}</p>
                        <p><strong>Quantité:</strong> {{ $accessoire['quantity'] }}</p>
                        <p><strong>*********</strong></p>
                    @endforeach
                @else
                    <p>No accessories selected.</p>
                @endif
            @endisset
        </section>

        <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form">
            @csrf
            <input type="hidden" name="debutReservation" value="{{ $dateDepart }}">
            <input type="hidden" name="finReservation" value="{{ $dateRetour }}">
            <input type="hidden" name="pickUp" value="{{ $pickUp }}">
            <input type="hidden" name="dropOff" value="{{ $dropOff }}">
            <input type="hidden" name="statut" value="confirmed">
            <input type="hidden" name="client_id" value="{{ $client_id }}">
            <input type="hidden" name="secondDriver" value="{{ json_encode($second_driver_info) }}">
            <input type="hidden" name="codeContrat" value="0000">
            <input type="hidden" name="voiture_id" value="{{ $voiture_id }}">
            <input type="hidden" name="prixVoiture" value="{{ $price }}">
            <input type="hidden" name="total" value="{{ $total_price }}">
            <input type="hidden" name="accessoires_selection" value="{{ json_encode($accessoires_selection) }}">

            <button type="submit" class="submit-button">Ajouter réservation</button>
        </form>
    </div>
</body>

</html>
