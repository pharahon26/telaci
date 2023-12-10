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
        font-size: 20px;
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

    .button-container {
        display: flex;
        width: 62rem;
        justify-content: space-between;
    }

    .button-container a,
    .button-container button {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 2.5rem;
        width: 20rem;
        color: black;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
        border: 3px solid black;
        background-color: white;
        border-radius: 3rem;
        transition: all ease 0.3s;
    }

    .button-container a:hover,
    .button-container button:hover {
        border: 3px solid #1e9dfe;
        color: #1e9dfe;
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

    .show-menu a,
    .show-menu button {
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

    .show-menu a.active,
    .show-menu button.active {
        color: #1e9dfe;
        border-bottom: 2px solid #1e9dfe;
    }

    .show-menu a:hover,
    .show-menu button:hover {}

    .burger-menu-button-container {
        display: none;
    }

    .burger-menu-button {
        display: flex;
        flex-direction: column;
        cursor: pointer;
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
        .burger-menu-button-container {
            display: flex;
            align-items: center;
        }

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
            <img src="{{ asset('assets/img/logo/logo.png') }}" class="logo-tela" alt="">
        </div>
        <div class="button-container">
            @auth
                <a href="{{ route('logout') }}">Se Déconnecter</a>
                <a href="{{ route('profil.index') }}">Mon profil</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModale">
                    Verifier mon pass
                </button>
                <a href="{{ route('passvisite.index') }}">Acheter un pass</a>
                <a href="{{ route('abonnement.show_form') }}">Souscrire abonnement</a>
            @else
                <a href="{{ route('login.index') }}">Se connecter</a>
                <a href="{{ route('inscription.create') }}">S'abonner</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModale">
                    Verifier mon pass
                </button>
                <a href="{{ route('passvisite.index') }}">Acheter un pass</a>
                <a href="{{ route('abonnement.show_form') }}">Souscrire abonnement</a>
            @endif
        </div>


        <div class="menu-items" id="menu-items">
            @auth
                <a href="{{ route('index') }}" class="{{ Request::is('/') ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('logout') }}">Se Déconnecter</a>
                <a href="{{ route('profil.index') }}">Mon profil</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModale">
                    Verifier mon pass
                </button>
                <a href="{{ route('passvisite.index') }}">Acheter un pass</a>
                <a href="{{ route('abonnement.show_form') }}">Souscrire abonnement</a>
                <a href="{{ route('about') }}" class="{{ Request::is('a-propos') ? 'active' : '' }}">A propos</a>
                <a href="{{ route('maison.choix') }}" class="{{ Request::is('maisons/choix') ? 'active' : '' }}">Maison à
                    louer</a>
                <a href="{{ route('ebanking.index') }}" class="{{ Request::is('finance') ? 'active' : '' }}">Tela
                    finance</a>
                <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">Tela TV</a>
                <a href="{{ route('condition.index') }}" class="{{ Request::is('condition') ? 'active' : '' }}">CGU</a>
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contacts</a>
            @else
                <a href="{{ route('index') }}" class="{{ Request::is('/') ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('login.index') }}">Se connecter</a>
                <a href="{{ route('inscription.create') }}">S'abonner</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModale">
                    Verifier mon pass
                </button>
                <a href="{{ route('passvisite.index') }}">Acheter un pass</a>
                <a href="{{ route('abonnement.show_form') }}">Souscrire abonnement</a>
                <a href="{{ route('about') }}" class="{{ Request::is('a-propos') ? 'active' : '' }}">A propos</a>
                <a href="{{ route('maison.choix') }}" class="{{ Request::is('maisons/choix') ? 'active' : '' }}">Maison à
                    louer</a>
                <a href="{{ route('ebanking.index') }}" class="{{ Request::is('finance') ? 'active' : '' }}">Tela
                    finance</a>
                <a href="{{ route('tv.index') }}" class="{{ Request::is('programmes_tv') ? 'active' : '' }}">Tela TV</a>
                <a href="{{ route('condition.index') }}" class="{{ Request::is('condition') ? 'active' : '' }}">CGU</a>
                <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contacts</a>
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
        <a href="{{ route('condition.index') }}" class="{{ Request::is('condition') ? 'active' : '' }}">CGU</a>
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
