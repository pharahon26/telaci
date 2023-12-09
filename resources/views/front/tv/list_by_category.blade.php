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
        <div class="telatv-grid-container">

                @if($datas->count()>0)
                @foreach($datas as $data)
                    <div class="pub-link">
                        <p>{{$data->nom}}</p>
                        <video controls height="300px" width="100%">
                            <source src="{{asset('assets/videos')}}/{{$data->link}}" type="video/mp4">
                        </video>
                    </div>
                @endforeach
                @else
                <h3 class="text-danger text-center">Aucune émission disponible pour le moment</h3>
                @endif

        </div>
    </div>
@endsection
