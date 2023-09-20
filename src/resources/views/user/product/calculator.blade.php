@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

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
                <span class="sb-title">Check where your drone could go!</span>
            </div>
            <input type="text" placeholder="Address" id="location-input" />
            <input type="text" placeholder="Apt, Suite, etc (optional)" />
            <input type="text" placeholder="City" id="locality-input" />
            <div class="half-input-container">
                <input type="text" class="half-input" placeholder="State/Province" id="administrative_area_level_1-input" />
                <input type="text" class="half-input" placeholder="Zip/Postal code" id="postal_code-input" />
            </div>
            <input type="text" placeholder="Country" id="country-input" />
            
            <form>
                <!-- create a select for the size -->
                <label for="size">Size:</label>
                <select name="size" id="size">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </form>
            <!-- make a hidden button -->
            <button type="button" id="circle" style="display: none;"
            >yo</button>
        </div>
        <div class="map" id="gmp-map"></div>
      </div>
      <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_ID')}}&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>

  </div>
</body>

</html>


@endsection