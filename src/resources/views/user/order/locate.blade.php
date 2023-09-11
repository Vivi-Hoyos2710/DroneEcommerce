@extends('layouts.app')

@section('title')
@section('content')
<!DOCTYPE html>
<html>

<head>
    <title>Address Selection</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">

    <script src="{{ asset('js/map.js') }}"></script>
</head>

<body>
  <div class="container" style="display: flex; justify-content: center;">
      <div class="card-container">
        <div class="panel">
            <div>
                <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                <span class="sb-title">Address Selection</span>
            </div>
            <input type="text" placeholder="Address" id="location-input" />
            <input type="text" placeholder="Apt, Suite, etc (optional)" />
            <input type="text" placeholder="City" id="locality-input" />
            <div class="half-input-container">
                <input type="text" class="half-input" placeholder="State/Province" id="administrative_area_level_1-input" />
                <input type="text" class="half-input" placeholder="Zip/Postal code" id="postal_code-input" />
            </div>
            <input type="text" placeholder="Country" id="country-input" />
            <button type="button" class="button-cta" onclick="getAddress()">Select address</button>
            <form method="POST" action="{{ route('cart.purchase') }}">
                @csrf <!-- CSRF token for security -->
                <input id="address" name="address" placeholder="Address" type="hidden" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500" required>

                <!-- Purchase Button -->
                <button 
                  type="submit" 
                  id="purchase" 
                  class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full" 
                  disabled 
                  style="opacity: 0.5; background-color: #bdc3c7;">
                  Purchase
                </button>
            </form>
        </div>
        <div class="map" id="gmp-map"></div>
      </div>
      <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_ID')}}&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>

  </div>
</body>

</html>

@endsection
