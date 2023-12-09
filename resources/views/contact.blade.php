@extends('layouts.front_app')
@section('content')

<div class="contact-container">
    <div class="contact-info">
        <div class="contact-title">
            <p>Contact</p>
        </div>
        <div class="contact-section">
            <div class="call-center">
                <p class="contact-text">Call center & PUB</p>
                <div class="contact-details">
                    <p>+225 05 84 02 67 15</p>
                    <p>+225 07 00 00 00 00</p>
                </div>
            </div>
            <div class="whatsapp">
                <p class="contact-text">Whatsapp pour transfert de photos</p>
                <div class="contact-details">
                    <p>+225 05 84 02 67 15</p>
                    <p>+225 01 00 00 00 00 00</p>
                </div>
            </div>
        </div>
        <div class="email-section">
            <p class="contact-text">Email</p>
            <p class="email-details">infos@tela.com</p>
        </div>
        <div class="social-section">
            <p class="contact-text">Social</p>
            <div class="social-network-logo">
                <div class="facebook-logo">
                    <a href=""><img src="{{asset('assets/img/facebook.png')}}" alt=""> </a>
                </div>
                <div class="twitter-logo">
                    <a href=""><img src="{{asset('assets/img/twitter.png')}}" alt=""> </a>
                </div>
                <div class="instagram-logo">
                    <a href=""><img src="{{asset('assets/img/instagram.png')}}" alt=""> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-logo-container">
        <img src="{{asset('assets/img/LOGO.png')}}" alt="logo-tela" height="200px" />
    </div>
</div>

@endsection