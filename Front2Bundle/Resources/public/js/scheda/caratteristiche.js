    var map;
    $(document).ready(function(){
      map = new GMaps({
        el: '#gmap',
        lat: lat,
        lng: lon,
        zoomControl : true,
        zoomControlOpt: {
            style : 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
      });
    });