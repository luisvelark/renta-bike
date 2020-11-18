<!-- 
<div>
    <h1>Buscar puntos de entrega y devolución</h1>
    <div id="map" style="height: 400px; width: 100px"></div>
    <script>
        var mapa;
        var coordenadas;
        var marker;

        function initMap() {
            coordenadas = {
                lat: -45.8609651,
                log: -66.4884351
            };
            mapa = new google.maps.Map(document.getElementById("map"), {zoom: 4, center: coordenadas});
            marker = new google.Marker({postion: coordenadas, map: mapa});

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap" async defer></script>
</div> -->
<!-- <div onload="load()" onunload="GUnload()">
    <body onload="load()" onunload="GUnload()">
    <div id="mapa" style="width: 500px; height: 400px; color: black;"></div>


</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=load"></script>
<script type="text/javascript">
    function load() {
        if (GBrowserIsCompatible()) {
            var latitud = 48.858729;
            var longitud = 2.352448;
            var zoom = 15;
            var mapa = new GMap2(document.getElementById("mapa"));
            mapa.setCenter(new GLatLng(latitud, longitud), zoom);
        }
    }
</script> -->