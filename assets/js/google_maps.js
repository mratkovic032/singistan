
function initMap() {
    
    var myCenter = new google.maps.LatLng(44.782977, 20.478502);
    var mapProp = {
        center: myCenter,
        zoom: 17,
        scrollwheel: false,
        draggable: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP        
    };

    var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
    var marker = new google.maps.Marker({
        position: myCenter,
        map: map
    });


    google.maps.event.addDomListener(window, "resize", function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
}