<style>
    .navbar-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 2rem;
        width: 100%;
    }

    .navbar-box-container-top,
    .link-container {
        border-bottom: 3px solid black;
    }

    .navbar-container>* {
        display: flex;
        justify-content: space-between;
    }

    .logo-tela {
        height: 80px;
    }

    .navbar-box-container-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0px;
    }

    .navbar-text {
        font-family: 'Kanit', sans-serif;
        text-align: center;
        align-self: center;
        color: black;
    }

    .hidden {
        display: none;
    }

    .link-container {
        margin-top: 4rem;
        padding-bottom: 0.5rem;
        margin-bottom: 2rem;
    }

    .link-container a.active {
        color: #1e9dfe;
    }

    .link-container a {
        font-size: 13px;
        font-weight: 500;
        color: black;
        text-decoration: none;
    }

    .link-container a:hover {
        transition: all ease 0.2s;
        color: #1e9dfe;
    }

    .navbar-text {
        font-family: "Aref Ruqaa Ink", serif;
        text-align: center;
        align-self: center;
        color: black;
    }


    .menu-items {
        display: none;
    }

    .close-button {
        align-self: flex-end;
        cursor: pointer;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .show-menu {
        display: flex;
        /* align-items: flex-start; */
        flex-direction: column;
        position: fixed;
        padding: 8rem 0 0 5rem;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 2;
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .show-menu a {
        display: flex;
        margin: 10px;
        color: black;
        border: none;
        font-weight: bold;
        width: max-content;
        cursor: pointer;
        font-size: 16px;
        background-color: white;
        transition: all ease 0.3s;
        text-decoration: none;
    }

    .show-menu button {
        width: 100%;
    }

    .show-menu button a {
        text-align: center;
        color: white;
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        font-weight: normal;
        margin: 0;
        background-color: transparent;
    }

    .show-menu a.active {
        color: #1e9dfe;
        border-bottom: 2px solid #1e9dfe;
    }

    .btn-container {
        position: relative;
        top: 5%;
        left: 3%;
        width: max-content;
        display: flex;
        height: 6rem;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
    }

    .burger-menu-button-container {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .burger-menu-button {
        display: flex;
        flex-direction: column;
        background: none;
        border: none;
        padding-right: 10px;
        z-index: 3;
    }

    .burger-line {
        width: 30px;
        height: 3px;
        background-color: #333;
        margin: 5px 0;
        transition: all 0.3s ease-in-out;
    }

    .burger-menu-button.close .burger-line:nth-child(1) {
        transform: translateY(15px) rotate(45deg);
    }

    .burger-menu-button.close .burger-line:nth-child(2) {
        opacity: 0;
    }

    .burger-menu-button.close .burger-line:nth-child(3) {
        transform: translateY(-15px) rotate(-45deg);
    }



    @media screen and (max-width: 1000px) {

        #menu-text {
            max-height: 2em;
            overflow: hidden;
            transition: max-height 0.3s;
            z-index: 3;
        }

        .menu-closed #menu-text {
            max-height: 2em;
            overflow: hidden;
            transition: max-height 0.3s;
        }

        .menu-open #menu-text {
            max-height: 5em;
            /* Ajustez cette valeur en fonction de la hauteur maximale souhaitée */
            overflow: hidden;
            transition: max-height 0.3s;
        }


        .button-container {
            display: none;
        }

        .navbar-box-container-top,
        .link-container {
            border-bottom: none;
        }

        .link-container {
            display: none;
        }
    }

    @media screen and (max-width: 800px) {
        .logo-tela {
            height: 60px;
        }

        .navbar-text {
            font-size: 20px;
        }
    }

    @media screen and (max-width: 500px) {
        .show-menu {
            padding: 8rem 0 0 3rem;

        }

        .logo-tela {
            height: 50px;
        }

        .navbar-text {
            text-align: start;
            font-size: 16px;
        }
    }
</style>
<div class="navbar-container">
    <div class="navbar-box-container-top">
        <div class="burger-menu-button-container" id="burger-menu-button-container">
            <div class="burger-menu-button" id="burger-menu-button">
                <div class="burger-line"></div>
                <div class="burger-line"></div>
                <div class="burger-line"></div>
            </div>
            <h5 id="menu-text">Menu</h5>
        </div>
        <div class="logo-tela">
            <a href="/">
                <img src="{{ asset('assets/img/logo/logo.png') }}" class="logo-tela" alt="logo-tela">
            </a>
        </div>
        <div class="menu-items" id="menu-items">
            @auth
                <a href="{{ route('index') }}" class="{{ Request::is('/') ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('profil.index') }}">Mon profil</a>
                <a href="{{ route('about') }}" class="{{ Request::is('a-propos') ? 'active' : '' }}">A propos</a>
                <a href="{{ route('maison.choix') }}" class="{{ Request::is('maisons/choix') ? 'active' : '' }}">Maison à
                    louer</a>
                <a href="{{ route('ebanking.index') }}" class="{{ Request::is('finance') ? 'active' : '' }}">Tela
                    finance</a>
                {{-- <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">CGU</a> --}}
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contacts</a>
                <div class="btn-container">
                    <button type="button" class="btn btn-danger">
                        <a href="{{ route('logout') }}">Se déconnecter</a>
                    </button>
                    <button type="button" data-bs-toggle="modal" class="btn btn-warning" data-bs-target="#exampleModale">
                        Verifier mon pass
                    </button>
                </div>
            @else
                <a href="{{ route('index') }}" class="{{ Request::is('/') ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('login.index') }}" class="{{ Request::is('connexion') ? 'active' : '' }}">Se
                    connecter</a>
                <a href="{{ route('inscription.create') }}"
                    class="{{ Request::is('inscriptions/create') ? 'active' : '' }}">S'abonner</a>

                <a href="{{ route('about') }}" class="{{ Request::is('a-propos') ? 'active' : '' }}">A propos</a>
                <a href="{{ route('maison.choix') }}" class="{{ Request::is('maisons/choix') ? 'active' : '' }}">Maison à
                    louer</a>
                <a href="{{ route('ebanking.index') }}" class="{{ Request::is('finance') ? 'active' : '' }}">Tela
                    finance</a>
                <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">Tela TV</a>
                {{-- <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">CGU</a> --}}
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contacts</a>
                <div class="btn-container">
                    <button type="button" data-bs-toggle="modal" class="btn btn-warning" data-bs-target="#exampleModale">
                        Verifier mon pass
                    </button>
                </div>
            @endauth
        </div>

    </div>
    <div class="link-container">
        <a href="{{ route('index') }}" class="{{ Request::is('/') ? 'active' : '' }}">Accueil</a>
        <a href="{{ route('about') }}" class="{{ Request::is('a-propos') ? 'active' : '' }}">A propos</a>
        <a href="{{ route('maison.choix') }}" class="{{ Request::is('maisons/choix') ? 'active' : '' }}">Maison à
            louer</a>
        <a href="{{ route('ebanking.index') }}" class="{{ Request::is('finance') ? 'active' : '' }}">Tela finance</a>
        <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">Tela TV</a>
        {{-- <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">CGU</a> --}}
        <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contacts</a>
    </div>
    @if (!Request::is('contact') && !Request::is('programmes_tv') && !Request::is('finance'))
        <h1 class="navbar-text">TELA, la meilleure plateforme de recherche de logements et de bureaux en Cote D'Ivoire
        </h1>
    @endif
    @if (Request::is('programmes_tv'))
        <h1 class="navbar-text">TELA TV, la meilleure chaine de télévision</h1>
    @endif
    @if (Request::is('finance'))
        <h1 class="navbar-text">TELA FINANCE, la meilleure microfinance</h1>
    @endif
</div>