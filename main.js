/**
 * Created by andre on 03/03/2017.
 */

var pupas = [
    new Point(41.492009, 2.362017, "5/2/2017 1:59:30"),
    new Point(41.555833, 2.4025, "4/2/2017 1:59:30"),
    new Point(41.533333, 2.45, "6/2/2017 1:59:30")
];

function Date_Comparator(Point1, Point2) {
    if (Point1.time.getTime() < Point2.time.getTime()) return 1;
    if (Point1.time.getTime() > Point2.time.getTime()) return -1;
    return 0;
}

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: 41.23, lng: 2.11}
    });
    pupas = pupas.sort(Date_Comparator);
    setMarkers(map);
}

function setMarkers(map) {
    for (var i = 0; i < pupas.length; i++) {
        pupas[i].show(map, i);
    }
    console.log(pupas);
}