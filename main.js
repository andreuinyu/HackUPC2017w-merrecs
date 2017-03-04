/**
 * Created by andre on 03/03/2017.
 */
var pupas = [
    ["Carlos", 41.492009, 2.362017, 1],
    ["Pavie", 41.555833, 2.4025,2],
    ["Sanch", 41.533333, 2.45,3]
];


function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: 41.23, lng: 2.11}
    });
    setMarkers(map);
}

function setMarkers(map) {
    var marker;
    for (var i = 0; i < pupas.length; i++) {
        var pupa = pupas[i];
        marker = new google.maps.Marker({
            map:map,
            draggable:false,
            optimized:false,
            position: {lat: pupa[1], lng: pupa[2]},
            zIndex: pupa[3],
            icon: 'point_animation.gif'
        });
    }
}