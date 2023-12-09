<style>
    .slider-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 600px; /* Ajustez la largeur selon vos besoins */
        margin: 0 auto;
    }

    .slides-container {
        display: flex;
        transition: transform 0.5s ease-in-out; /* Transition en douceur */
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
        position: relative;
    }

    .slide img {
        width: 100%;
        height: auto; /* Permet de conserver les proportions originales */
    }

    .carousel-arrows {
        z-index: 1;
        position: absolute;
        top: 50%;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }

    .arrow {
        border: none;
        background-color: transparent;
        padding: 10px;
        color: white;
        opacity: 90%;
        cursor: pointer;
        font-size: 30px;
    }
    .arrow:hover {
        border: none;
        padding: 10px;
        color: white;
        transition: all ease 0.5s;
        background-color: rgba(0, 0, 0, 0.50);
        cursor: pointer;
        font-size: 30px;
    }

    /* Ajoutez d'autres styles selon vos préférences */
</style>

<div class="slider-container" id="sliderContainer">
    <div class="carousel-arrows">
        <button class="arrow" onclick="prevSlide()">&#9664;</button>
        <button class="arrow" onclick="nextSlide()">&#9654;</button>
    </div>

    <div class="slides-container" id="slidesContainer">
        <!-- Ajoutez vos images ici -->
        <div class="slide"><img src="{{ asset('assets/img/slider/SLIDE1.jpeg') }}" alt="Slide 1"></div>
        <div class="slide"><img src="{{ asset('assets/img/slider/SLIDE2.jpg') }}" alt="Slide 2"></div>
        <div class="slide"><img src="{{ asset('assets/img/slider/SLIDE3.png') }}" alt="Slide 3"></div>
        <div class="slide"><img src="{{ asset('assets/img/slider/SLIDE4.png') }}" alt="Slide 4"></div>
        <div class="slide"><img src="{{ asset('assets/img/slider/SLIDE5.png') }}" alt="Slide 5"></div>
        <div class="slide"><img src="{{ asset('assets/img/slider/SLIDE6.png') }}" alt="Slide 6"></div>
    </div>
</div>

