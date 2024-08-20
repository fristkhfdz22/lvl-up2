
    function initMap() {
        var location = { lat: -6.8605, lng: 109.1197 }; // Ganti dengan koordinat lokasi restoran kamu
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location,
            mapTypeId: 'roadmap'
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }


