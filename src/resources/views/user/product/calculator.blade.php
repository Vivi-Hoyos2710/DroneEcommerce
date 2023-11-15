@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>{{ __('order.address_selection') }}</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <script src="{{ asset('js/map.js') }}"></script>
</head>

<body>
    <div class="container" style="display: flex; justify-content: center;">
        <div class="card-container">
            <div class="panel">
                <div>
                    <img class="sb-title-icon"
                        src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                    <span class="sb-title">{{ __('product.calculator_title') }}</span>
                </div>
                <input type="text" placeholder="{{ __('product.address') }}" id="location-input" />
                <input type="text" placeholder="{{ __('product.apt_suite_optional') }}" />
                <input type="text" placeholder="{{ __('product.city') }}" id="locality-input" />
                <div class="half-input-container">
                    <input type="text" class="half-input"
                        placeholder="{{ __('product.state_province') }}" id="administrative_area_level_1-input" />
                    <input type="text" class="half-input"
                        placeholder="{{ __('product.zip_postal_code') }}" id="postal_code-input" />
                </div>
                <input type="text" placeholder="{{ __('product.country') }}" id="country-input" />

                <form>
                    <label for="size"> {{ __('product.size') }} </label>
                    <select name="size" id="size">
                        <option value="small">{{ __('product.small') }}</option>
                        <option value="medium">{{ __('product.medium') }}</option>
                        <option value="large">{{ __('product.large') }}</option>
                    </select>
                </form>
                <!-- hidden button for functionality -->
                <button type="button" id="circle" style="display: none;">yo</button>
            </div>
            <div class="map" id="gmp-map"></div>
        </div>
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_ID') }}&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC"
            async defer></script>
    </div>
</body>

</html>
@endsection
