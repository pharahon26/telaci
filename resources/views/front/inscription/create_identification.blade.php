@extends('layouts.front_app')
@section('content')
    <style>
        .registration-form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .registration-form-container form {
            display: flex;
            flex-direction: column;
            /* align-items: center; */
            justify-content: space-between;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 30px;
            height: 90vh;
            width: 100%;
            margin-bottom: 2rem;
        }

        .registration-form-container .text {
            font-size: 2rem;
            color: #3498db;
            /* text-align: center; */
            margin-bottom: 20px;
        }

        .input-field,
        .photo-input {
            width: 100%;
            border: 1px solid #ced4da;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .checkbox-label input {
            margin-right: 10px;
        }

        .button {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px;
            border-radius: 4px;
            transition: background-color 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .link {
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        .link:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 900px) {
            .registration-form-container form {

                width: 90vw;
            }

        }

        @media screen and (max-height: 750px) {
            .registration-form-container form {
                height: 90vh;
            }
        }

        @media screen and (max-height: 600px) {
            .registration-form-container form {
                gap: 20px;
            }
        }

        @media screen and (max-width: 500px) {
            .registration-form-container .text {
                font-size: 40px;
            }

            .input-field {
                width: 90%;
            }
        }

        @media screen and (max-width: 400px) {
            .registration-form-container .text {
                font-size: 35px;
            }
        }
    </style>
    <div class="registration-form-container">
        <form action="{{ route('inscription.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text">Inscription</h1>
            @include('components.message')
            <input type="text" name="nom" class="input-field" value="{{ old('nom') }}" required placeholder="Nom">
            <input type="text" name="prenom" class="input-field" value="{{ old('prenom') }}" required
                placeholder="Prenom">
            <input type="text" name="phone" class="input-field" placeholder="Numéro de téléphone"
                value="{{ old('phone') }}" required>
            <label for="" class="photo-label">
                Photo d'identité
                <input type="file" name="photo" class="photo-input" value="{{ old('photo') }}" required>
            </label>

            <input type="password" name="password" class="input-field" placeholder="Mot de passe"
                value="{{ old('password') }}" required>

            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" class="input-field"
                value="{{ old('password_confirmation') }}" required>

            <a href="{{ route('condition.index') }}">Consulter les conditions générales d'utilisations</a>

            <label for="" class="text-black">Accepter les conditions générales d'utilisations</label>
            <div>
                <input type="checkbox" name="accepter" class="form-check-input">
            </div>

            <button type="submit" class="button">CREER VOTRE PROFIL</button>
            <br><br><br>

        </form>
    </div>
@endsection
