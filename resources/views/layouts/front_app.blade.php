<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TELA</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/LOGO.png') }}" type="image/x-icon" />
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/maison.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@900&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa+Ink:wght@700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>

</head>

<body>
    <div class="App">
        @include('components.front_navbar')
        @yield('content')
        <div class="modal fade" id="exampleModale" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-secondary text-center" id="exampleModalLabele">Verification du pass
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-danger text-center">Veuillez saisir le code du pass visite </h5>
                        <form action="{{ route('passvisite.check') }}" method="get">
                            @csrf
                            <input type="text" name="code" required value="" class="form-control"> <br>
                            <button type="submit" class="btn btn-success">Verifier</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la
                                fenetre</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        {{--                                                <a href="{{route('maison.show.logement',$data->ref)}}" class="btn btn-success">Consulter les photos</a> --}}
                    </div>
                </div>
            </div>
        </div>

        @include('components.footer')
    </div>

    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script>
        function showCommodities() {
            // Récupérer la case à cocher et le champ à afficher
            var check = document.getElementById('maisonbasse');
            var balconavant = document.getElementById('balconavant');
            var balconarriere = document.getElementById('balconarriere');

            // Ajouter un écouteur d'événement pour le changement de la case à cocher
            check.addEventListener('change', function() {
                // Vérifier si la case est cochée
                if (check.checked) {
                    // Afficher le champ
                    balconavant.style.display = 'block';
                    balconarriere.style.display = 'block';
                } else {
                    // Masquer le champ
                    balconavant.style.display = 'none';
                    balconarriere.style.display = 'none';
                }
            });
        }
    </script>
    <script>
        @if (session('success'))

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: '{{ session('
                                                                                                                                            success ') }}'
            });
        @endif

        @if (session('error'))

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 8000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'error',
                title: '{{ session('
                                                                                                                                            error ') }}'
            });
        @endif
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
    const burgerMenuButtonContainer = document.getElementById('burger-menu-button-container');
    const burgerMenuButton = document.getElementById('burger-menu-button');
    const menuItems = document.getElementById('menu-items');
    const menuText = document.getElementById('menu-text');

    burgerMenuButtonContainer.addEventListener('click', function() {
        burgerMenuButton.classList.toggle('close');
        menuItems.classList.toggle('show-menu');
        document.body.classList.toggle('no-scroll');

        // Changer le texte de l'élément h5 en fonction de l'état du menu
        if (burgerMenuButton.classList.contains('close')) {
            menuText.classList.remove('menu-closed');
            menuText.classList.add('menu-open');
            menuText.textContent = 'Fermer';
        } else {
            menuText.classList.remove('menu-open');
            menuText.classList.add('menu-closed');
            menuText.textContent = 'Menu';
        }
    });

    // Fermer le menu lorsque l'utilisateur clique sur un lien dans le menu
    const menuButtons = document.querySelectorAll('.menu-items button');
    menuButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            burgerMenuButton.classList.remove('close');
            menuItems.classList.remove('show-menu');
            document.body.classList.remove('no-scroll');
            
            // Rétablir le texte "Menu" lorsque le menu est fermé
            menuText.classList.remove('menu-open');
            menuText.classList.add('menu-closed');
            menuText.textContent = 'Menu';
        });
    });
});

    </script>

    <script>
        var currentSlide = 0;
        var slidesContainer = document.getElementById('slidesContainer');
        var totalSlides = document.querySelectorAll('.slide').length;

        function showSlide(index) {
            currentSlide = index;
            var translateValue = -index * 100 + '%';
            slidesContainer.style.transform = 'translateX(' + translateValue + ')';
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 10000);
    </script>

</body>

</html>