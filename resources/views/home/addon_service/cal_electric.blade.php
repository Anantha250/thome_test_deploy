@extends('layouts.layout_home')

@section('content')
    <link rel="stylesheet" href="/css/home/addon_service/cal_electric.css">
    <div class="cal-container" data-aos="zoom-in-down">
        <div class="cal">
            <div class="cal-item">
                <div>
                    <h2><i class="fas fa-calculator"></i> {{ __('cal_electric.cal_title') }}</h2>
                    <p><i class="fas fa-info-circle"></i> {{ __('cal_electric.cal_subtitle1') }}</p>
                    <p><i class="fas fa-check-circle"></i> {{ __('cal_electric.cal_subtitle2') }}</p>
                    <p><i class="fas fa-phone"></i> {{ __('cal_electric.cal_subtitle3') }}</p>
                </div>
                <div class="logo-container">
                    <img src="https://img.freepik.com/free-vector/household-public-utilities-design-concept-illustrated-consumption-accounting-energetic-water-resources-isometric-vector-illustration_98292-9053.jpg?t=st=1738919465~exp=1738923065~hmac=e56ee21aff5e511ecc26ae700c498f651b595e534afce2935ef0b8959ced7d59&w=1060"
                        alt="House Logo">
                </div>
            </div>

            <!-- Right side iframe -->
            <iframe class="cal-iframe" src="https://requestform.thomeinspector.com/calc/"></iframe>
        </div>
    </div>

    <!-- cal-details strat -->
    <div class="hero" data-aos="fade-up">
        <h1>{{ __('cal_electric.why_cal_title') }}</h1>
        <p>{{ __('cal_electric.why_cal_desc') }}</p>
        <a href="https://requestform.thomeinspector.com/calc/" class="btn">{{ __('cal_electric.why_cal_btn') }}</a>
    </div>

    <!-- Content Section -->
    <section id="details" class="content">
        <div class="container">
            <h2 data-aos="fade-right">{{ __('cal_electric.section_title') }}</h2>
            <p data-aos="fade-left">{{ __('cal_electric.section_desc') }}</p>

            <div class="grid">
                <div class="card" data-aos="zoom-in">
                    <h3>{{ __('cal_electric.card1_title') }}</h3>
                    <p>{{ __('cal_electric.card1_desc') }}</p>
                </div>
                <div class="card" data-aos="zoom-in" data-aos-delay="100">
                    <h3>{{ __('cal_electric.card2_title') }}</h3>
                    <p>{{ __('cal_electric.card2_desc') }}</p>
                </div>
                <div class="card" data-aos="zoom-in" data-aos-delay="200">
                    <h3>{{ __('cal_electric.card3_title') }}</h3>
                    <p>{{ __('cal_electric.card3_desc') }}</p>
                </div>
                <div class="card" data-aos="zoom-in" data-aos-delay="300">
                    <h3>{{ __('cal_electric.card4_title') }}</h3>
                    <p>{{ __('cal_electric.card4_desc') }}</p>
                </div>
                <div class="card" data-aos="zoom-in" data-aos-delay="400">
                    <h3>{{ __('cal_electric.card5_title') }}</h3>
                    <p>{{ __('cal_electric.card5_desc') }}</p>
                </div>
                <div class="card" data-aos="zoom-in" data-aos-delay="500">
                    <h3>{{ __('cal_electric.card6_title') }}</h3>
                    <p>{{ __('cal_electric.card6_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta" data-aos="fade-up">
        <div class="container">
            <h2>{{ __('cal_electric.cta_title') }}</h2>
            <a href="https://page.line.me/t.home?openQrModal=true" class="btn">{{ __('cal_electric.cta_btn') }}</a>
        </div>
    </section>
@endsection
