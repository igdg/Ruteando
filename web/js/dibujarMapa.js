/*$(document).on('ready', function(){
    initMap();

});*/

function initMap(){
    var map = new google.maps.Map(document.getElementById('map1'), {
        zoom: 3,
        center: {lat: 0, lng: -180},
        mapTypeId: 'terrain',
        clickableIcons: false,
    });

    $.ajax({
        type: "GET",
        dataType: "json",
        url: rutaPath,
        success:function(data){
            var array = [];
            $.each(data, function(k, v){
                array.push({lat: parseFloat(v.lat), lng: parseFloat(v.lng)});
            });


            var polyLine = new google.maps.Polyline({
                path: array,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            polyLine.setMap(map);

            var bounds=new google.maps.LatLngBounds();
            $.each(array, function(k,v){
                bounds.extend(v);
            });

            map.setCenter(bounds.getCenter());
            map.fitBounds(bounds);
            var lengthInMeters = google.maps.geometry.spherical.computeLength(polyLine.getPath());
            var lengthInKm = lengthInMeters/1000;
            $('#distRuta').text(lengthInKm.toFixed(1) + " km");
        }
    });
}

//Carga
window.addEventListener('load',function(){
    initMap();
},false);


