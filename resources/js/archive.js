function myMap() {
    var mapProp= {
      center:new google.maps.LatLng(33.8869,9.5375),
      zoom:8,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

    var marker = new google.maps.Marker({
      position: mapProp,
      map: map,
      title: 'Selectionner votre domicile',
      draggable: true
    });


    google.maps.event.addListener(marker, 'dragend', function (evt) {
      document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' +
                     evt.latLng.lat().toFixed(3) + ' Current Lng: '
                     + evt.latLng.lng().toFixed(3) + '</p>';
    });


}

{/* <script src="https://maps.googleapis.com/maps/api/js?key=&callback=myMap"></script> */}
