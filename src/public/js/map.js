"use strict";
const componentForm = [
  'location',
  'locality',
  'administrative_area_level_1',
  'country',
  'postal_code',
];

function initMap() {
  const CONFIGURATION = {
    "ctaTitle": "Select address",
    "mapOptions": {"center":{"lat":37.4221,"lng":-122.0841},"fullscreenControl":true,"mapTypeControl":false,"streetViewControl":true,"zoom":10,"zoomControl":true,"maxZoom":22,"mapId":""},
    "mapsApiKey": "AIzaSyAp0xD9szVZuzH2-R0lKL9nTYifnYQXuEE",
    "capabilities": {"addressAutocompleteControl":true,"mapDisplayControl":true,"ctaControl":true}
  };


  const getFormInputElement = (component) => document.getElementById(component + '-input');
  const map = new google.maps.Map(document.getElementById("gmp-map"), {
    zoom: CONFIGURATION.mapOptions.zoom,
    center: { lat: 37.4221, lng: -122.0841 },
    mapTypeControl: false,
    fullscreenControl: CONFIGURATION.mapOptions.fullscreenControl,
    zoomControl: CONFIGURATION.mapOptions.zoomControl,
    streetViewControl: CONFIGURATION.mapOptions.streetViewControl
  });
  const marker = new google.maps.Marker({map: map, draggable: false});
  const autocompleteInput = getFormInputElement('location');
  const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
    fields: ["address_components", "geometry", "name"],
    types: ["address"],
  });
  autocomplete.addListener('place_changed', function () {
    marker.setVisible(false);
    const place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert('No details available for input: \'' + place.name + '\'');
      return;
    }
    renderAddress(place);
    fillInAddress(place);
  });

  function fillInAddress(place) {  // optional parameter
    const addressNameFormat = {
      'street_number': 'short_name',
      'route': 'long_name',
      'locality': 'long_name',
      'administrative_area_level_1': 'short_name',
      'country': 'long_name',
      'postal_code': 'short_name',
    };
    const getAddressComp = function (type) {
      for (const component of place.address_components) {
        if (component.types[0] === type) {
          return component[addressNameFormat[type]];
        }
      }
      return '';
    };
    getFormInputElement('location').value = getAddressComp('street_number') + ' '
              + getAddressComp('route');
    for (const component of componentForm) {
      // Location field is handled separately above as it has different logic.
      if (component !== 'location') {
        getFormInputElement(component).value = getAddressComp(component);
      }
    }
  }

  function renderAddress(place) {
    map.setCenter(place.geometry.location);
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
  }
}

function getAddress() {
  const getFormInputElement = (component) => document.getElementById(component + '-input');
  
  let address = '';
  for (const component of componentForm) {
      address += getFormInputElement(component).value + ' ';
    
  }
  // getElementById('address').value = address;


  // if data is not empty set input to data and enable purchase button
  // check if address is not empty or composed only of spaces
  if (address.trim() !== '') {
    console.log(address);
    console.log(address.length);
    document.getElementById('address').placeholder = address;
    document.getElementById('address').value = address;
    document.getElementById('purchase').disabled = false;
    document.getElementById('purchase').style.backgroundColor = '#2ecc71'; 
    document.getElementById('purchase').style.opacity = '1';
  }
  // if data is empty disable purchase button
  else {
    document.getElementById('purchase').disabled = true;
    document.getElementById('purchase').style.backgroundColor = '#bdc3c7'; 
    document.getElementById('purchase').style.opacity = '0.5';
  }


} 