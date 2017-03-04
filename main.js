/**
 * Created by andre on 03/03/2017.
 */

//

var map;
var pupas = [
    new Point(41.492009, 2.362017, "21:00"),
    new Point(41.555833, 2.4025, "22:00"),
    new Point(41.533333, 2.45, "23:00"),
];


function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: 41.23, lng: 2.11}
    });
    setMarkers(map);
}

function setMarkers(map) {
    for (var i = 0; i < pupas.length; i++) {
        var pupa = pupas[i];
        pupa.show(map)
    }
}

