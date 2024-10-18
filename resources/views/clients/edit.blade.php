<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="{{ asset('create.css') }}">--}}    
    <link rel="stylesheet" href="{{ asset('edit.css') }}">
    {{--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Modifier une voiture</title>
</head>
<body>
    <div class="container">
        <h1>Location Voiture</h1>
        <div class="car-management">
            <h2>Gestion des voitures</h2>
            {{-- @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif --}}
            {{-- @if(session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif --}}
            <form action="{{ route('clients.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT') 
            
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="tel">Tel</label>
                    <input type="tel" id="tel" name="Tel" value="{{ old('Tel', $user->client->Tel) }}">
                    @error('Tel')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="Permis">Permis</label>
                    <input type="text" id="Permis" name="Permis" value="{{ old('Permis', $user->client->Permis) }}">
                    @error('Permis')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="Adresse">Adresse</label>
                    <input type="text" id="Adresse" name="Adresse" value="{{ old('Adresse', $user->client->Adresse) }}">
                    @error('Adresse')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="cin">National ID</label>
                    <input type="text" id="cin" name="cin" value="{{ old('cin', $user->client->cin) }}">
                    @error('cin')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="passport">Passport</label>
                    <input type="text" id="passport" name="passport" value="{{ old('passport', $user->client->passport) }}">
                    @error('passport')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-buttons">
                    <a href="{{ route('clients.index') }}" class="btn-cancel">Annuler</a>
                    <button type="reset" class="btn reset">Vider</button>
                    <button type="submit" class="btn submit">Modifier</button>
                </div>
            </form>
            
        </div>
    </div>
</body>

</html>