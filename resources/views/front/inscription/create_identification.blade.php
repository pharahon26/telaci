@extends('layouts.front_app')
@section('content')
    <style>
        .registration-form-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        .registration-form-container form {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            border: 3px solid #1e9dfe;
            border-radius: 4px;
            gap: 20px;
            width: 800px;
            /* Largeur fixe du formulaire */
            margin: 0 auto;
            /* Centrage horizontal */
            height: 80vh;
            /* 80% de la hauteur de l'écran */
            justify-content: center;
            /* Centrage vertical */
        }

        .registration-form-container .text {
            font-size: 45px;
            color: #1e9dfe;
        }

        .input-field {
            width: 80%;
            border: 2px solid #1e9dfe;
            padding: 8px;
            border-radius: 4px;
        }

        .checkbox-label {
            display: flex;
            font-weight: bold;
        }

        .checkbox-label p {
            color: #1e9dfe;
            margin-right: 1rem;
        }

        .checkbox-label input {
            border: 2px solid #1e9dfe;
        }

        .button {
            background-color: #1e9dfe;
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px 40px;
            border-radius: 4px;
            transition: background-color 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }


        .button:hover {
            background-color: #009fb8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* ... (autres styles) */

        .photo-label {
            display: flex;
            flex-direction: column;
            /* align-items: center; */
            width: 80%;
            color: #1e9dfe;
            font-weight: bold;
        }

        .photo-input {
            margin-top: 8px;
            width: 100%;
            color: gray;
            border: 2px solid #1e9dfe;
            padding: 8px;
            border-radius: 4px;
        }

        /* ... (autres styles) */

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
        <form action="{{ route('inscription.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
            @include('components.message')
            <h1 class="text">Inscription</h1>

            <input type="text" name="name" class="input-field" value="{{ old('name') }}" required
                placeholder="Nom & Prenom">
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

            <label for="" class="text-black">Devenir démarcheur</label>
            <div>
                Oui <input type="radio" name="is_demarcheur" class="" value="1" checked>
                Non <input type="radio" name="is_demarcheur" class="" value="0">
            </div>
            <button type="submit" class="button">CREER VOTRE PROFIL</button>
        </form>
        <a href="/">Retourner à la page d&apos;accueil</a>
    </div>
@endsection
