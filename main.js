/**
 * Created by andre on 03/03/2017.
 */

var map;
var pupas = [
    new Point(41.492009, 2.362017, "1/2/2017 1:59:30"),
    new Point(41.555833, 2.4025, "4/2/2017 1:59:30"),
    new Point(41.533333, 2.45, "6/2/2017 1:59:30"),
    new Point(41.7, 2.833333, "3/2/2017 1:59:30")
];
var selected_date;
var markers = [];

function Date_Comparator(Point1, Point2) {
    if (Point1.time.getTime() < Point2.time.getTime()) return 1;
    if (Point1.time.getTime() > Point2.time.getTime()) return -1;
    return 0;
}

function candiDate(s){ selected_date = new Date(s); }

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {
            lat: 41.23,
            lng: 2.11
        }
    });
    pupas = pupas.sort(Date_Comparator);
}

function deleteMarkers() {
    if (markers.length > 0){
        for (var i = 0; i < markers.length; i++) {
            if(markers[i]) {
                markers[i].setMap(null);
                markers[i] = null;
            }
        }
        markers.lenght = 0;
    }
}

function setMarkers() {
    if(markers){
        deleteMarkers();
    }
    for (var i = 0; i < pupas.length; i++) {
        var pupa = pupas[i];
        if (pupa.time.getTime() > selected_date.getTime()) {
            pupas[i].show(map, i);
        }else{
            break;
        }
    }
}

