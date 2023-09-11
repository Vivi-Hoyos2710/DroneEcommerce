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

  // Create an empty circle list to store the circles
  const circles = [];

  autocomplete.addListener('place_changed', function () {
    marker.setVisible(false);
    const place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert('No details available for input: \'' + place.name + '\'');
      return;
    }
    // if circle button exists render a radius
    if (document.getElementById('circle')) {
      renderRadius(place, circles);
    }
    renderAddress(place);
    fillInAddress(place);
  });

  function renderRadius(place, circles) {
    // clean previous circles
    for (let i = 0; i < circles.length; i++) {
      circles[i].setMap(null);
    }

    const circle = new google.maps.Circle({
      strokeColor: '#FF0000',
      strokeOpacity: 0.5,
      strokeWeight: 1,
      fillColor: '#FF0000',
      fillOpacity: 0.1,
      map,
      center: place.geometry.location,
      radius: getRadius(),
    });
    map.fitBounds(circle.getBounds());
    circles.push(circle);

    const radius = circle.getRadius();
    const center = circle.getCenter();
    console.log(radius);
    console.log(center);
    
    const extreme = google.maps.geometry.spherical.computeOffset(center, radius, 90);

    console.log(extreme);

    const lineSymbol = {
      path: google.maps.SymbolPath.CIRCLE,
      scale: 8,
      strokeColor: "#393",
    };
    // Create the polyline and add the symbol to it via the 'icons' property.
    const line = new google.maps.Polyline({
      path: [
        center,
        extreme
      ],
      icons: [
        {
          icon: lineSymbol,
          offset: "100%",
        },
      ],
      map: map,
    });
  
    animateCircle(line);
    circles.push(line);
  }
  
  // Use the DOM setInterval() function to change the offset of the symbol
  // at fixed intervals.
  function animateCircle(line) {
    let count = 0;
  
    window.setInterval(() => {
      count = (count + 1) % 200;
  
      const icons = line.get("icons");
  
      icons[0].offset = count / 2 + "%";
      line.set("icons", icons);
    }, 20);
  }

  function getRadius() {
    // Get size from input.
    const radius = document.getElementById('size').value;
    
    //Make a switch
    switch (radius) {
      case 'small':
        return 1000;
      case 'medium':
        return 2000;
      case 'large':
        return 3000;
    }
  }


  

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

