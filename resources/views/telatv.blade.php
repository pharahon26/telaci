@extends('layouts.front_app')
@section('content')
    <style>
        .telatv-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .video-container {
            width: 100%;
            margin-bottom: 3rem;
        }

        .video-container video {
            width: 100%;
        }

        .telatv-grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
            align-items: center;
            justify-items: center;
        }


        .pub-link,
        .live-link,
        .emission-link,
        .rediffusion-link,
        .sport-link,
        .filmMusic-link {
            text-align: center;
            width: 100%;
        }

        .pub-image,
        .live-image,
        .emission-image,
        .rediffusion-image,
        .sport-image,
        .filmMusic-image {
            object-fit: cover;
            width: 100%;
            height: 70vh;
        }

        @media screen and (max-width: 1000px) {
            .telatv-grid-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
            .pub-image,
            .live-image,
            .emission-image,
            .rediffusion-image,
            .sport-image,
            .filmMusic-image {
                width: 350px;
            }
           
        }
        @media screen and (max-width: 800px) {
            .telatv-grid-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
            .pub-image,
            .live-image,
            .emission-image,
            .rediffusion-image,
            .sport-image,
            .filmMusic-image {
                height: 60vh;
                width: 300px;
            }
           
        }
        @media screen and (max-width: 700px) {
            .telatv-grid-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
            .pub-image,
            .live-image,
            .emission-image,
            .rediffusion-image,
            .sport-image,
            .filmMusic-image {
                height: 50vh;
                width: 250px;
            }
           
        }
        @media screen and (max-width: 600px) {
            .telatv-grid-container {
            grid-template-columns: repeat(1, 1fr);
            gap: 20px;
        }
            .pub-image,
            .live-image,
            .emission-image,
            .rediffusion-image,
            .sport-image,
            .filmMusic-image {
                height: 50vh;
                width: 250px;
            }
           
        }
        @media screen and (max-width: 400px) {
            .telatv-grid-container {
            gap: 30px;
        }
            .pub-image,
            .live-image,
            .emission-image,
            .rediffusion-image,
            .sport-image,
            .filmMusic-image {
                height: 45vh;
                width: 200px;
            }
           
        }
    </style>
    <div class="telatv-container">
        <div class="video-container">
            <video autoplay loop muted>
                <source src="{{ URL::asset('assets/img/movie1.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="telatv-grid-container">
            <a href="#" class="pub-link">
                <img src={{ asset('assets/img/Pub.PNG') }} alt="pub-image" class="pub-image">
            </a>
            <a href="#" class="live-link">
                <img src={{ asset('assets/img/Live.PNG') }} alt="live-image" class="live-image">
            </a>
            <a href="#" class="emission-link">
                <img src={{ asset('assets/img/Emission.PNG') }} alt="emission-image" class="emission-image">
            </a>
            <a href="#" class="rediffusion-link">
                <img src={{ asset('assets/img/Rediffusion.PNG') }} alt="rediffusion-image" class="rediffusion-image">
            </a>
            <a href="#" class="sport-link">
                <img src={{ asset('assets/img/Sport.PNG') }} alt="sport-image" class="sport-image">
            </a>
            <a href="#" class="filmMusic-link">
                <img src={{ asset('assets/img/FilmMusic.PNG') }} alt="FilmMusic-image" class="filmMusic-image">
            </a>
        </div>
    </div>
@endsection
