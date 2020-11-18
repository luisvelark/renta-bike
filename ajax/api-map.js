function load() {
    if (GBrowserIsCompatible()) {
        var latitud = 48.858729;
        var longitud = 2.352448;
        var zoom = 15;
        var mapa = new GMap2(document.getElementById("mapa"));
        mapa.setCenter(new GLatLng(latitud, longitud), zoom);
    }
}