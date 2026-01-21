<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-4">
    <h3 class="text-lg font-medium text-gray-900">Ubicación</h3>
    
    <!-- Mapa -->
    <div id="map" style="height: 400px; width: 100%; border-radius: 8px; margin-bottom: 15px;"></div>

    <!-- Inputs ocultos que se envían con el formulario principal -->
    <!-- NOTA: Asegúrate de que estos inputs estén DENTRO de tu etiqueta <form> principal de actualización de perfil -->
    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $user->latitude) }}">
    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $user->longitude) }}">
    <input type="hidden" id="address" name="address" value="{{ old('address', $user->address) }}">

    <p class="text-sm text-gray-600">Dirección guardada: <span id="address_display">{{ $user->address ?? 'Sin dirección' }}</span></p>
</div>

<!-- Script Google Maps -->
<script>
    function initMap() {
        // Coordenadas iniciales (Del usuario o defecto Madrid)
        let userLat = {{ $user->latitude ?? 40.416775 }};
        let userLng = {{ $user->longitude ?? -3.703790 }};
        let myLatLng = { lat: userLat, lng: userLng };

        let map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: myLatLng,
        });

        let marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            draggable: true, // Importante: Permite moverlo
            title: "Mi Ubicación"
        });

        // Evento al soltar el marcador
        google.maps.event.addListener(marker, 'dragend', function(evt) {
            document.getElementById('latitude').value = evt.latLng.lat();
            document.getElementById('longitude').value = evt.latLng.lng();
            
            // Geocodificación Inversa (Coordenadas -> Dirección)
            let geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'location': evt.latLng }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    document.getElementById('address').value = results[0].formatted_address;
                    document.getElementById('address_display').innerText = results[0].formatted_address;
                }
            });
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY_AQUI&callback=initMap"></script>