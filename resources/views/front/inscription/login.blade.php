@extends('layouts.front_app')
@section('content')
    <style>
        .login-form-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-form-container form {
            display: flex;
            flex-direction: column;
            /* align-items: center; */
            justify-content: space-between;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 30px;
            height: 50vh;
            width: 100%;
            margin-bottom: 2rem;
        }

        .login-form-container .text {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
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
            color: #3498db;
            text-decoration: none;
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        .link:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 900px) {
            .login-form-container {
                height: 70vh
            }
            .login-form-container form {
                width: 90vw;
            }

        }

        @media screen and (max-width: 700px) {
            .login-form-container form {
                gap: 40px;
                width: 90vw;
            }

        }

        @media screen and (max-width: 500px) {

            .input-field {
                width: 90%;
                margin-bottom: 10px;
            }
        }

        @media screen and (max-width: 400px) {
            .login-form-container form {
                gap: 30px;
            }
        }
    </style>
    <div class="login-form-container">
        <form action="{{ route('connexion.index') }}" method="post">
            @csrf
            @include('components.message')
            <h1 class="text">Connexion</h1>
            <center>
                <div class="">
                    <input type="text" name="phone" class="input-field" value="{{ old('phone') }}"
                        placeholder="Numéro de téléphone" required>
                    <input type="password" name="password" class="input-field" value="{{ old('password') }}"
                        placeholder="Mot de passe" required>
                </div>
            </center>

            <button type="submit" class="button">Connexion</button>

        </form>
        <a href="/">Retourner à la page d&apos;accueil</a>
    </div>
@endsection
