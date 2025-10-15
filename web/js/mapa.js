/*$(document).on('ready', function(){
    initMap();

})*/


function initMap() {
    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 40.3964129438718, lng: -3.7129999999999654},
        zoom: 5,
        clickableIcons: false,
    });
    var poly = new google.maps.Polyline({
        strokeColor: '#FF0000',
        strokeOpacity: 1,
        strokeWeight: 3,
        map: map
    });

    google.maps.event.addListener(map, 'click', function(event) {
        addLatLngToPoly(event.latLng, poly);
    });
}

function addLatLngToPoly(latLng, poly) {
    var path = poly.getPath();
    path.push(latLng);
    document.getElementById('puntos_control').value+=latLng+"*";
}

//Carga
window.addEventListener('load',function(){
    initMap();
},false);


