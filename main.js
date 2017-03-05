/**
 * Created by andre on 03/03/2017.
 */

var map;

var emergencies = [];
    /*
    [
    new Point(41.492009, 2.362017, "1/2/2017 1:59:30"),
    new Point(41.555833, 2.4025, "4/2/2017 1:59:30"),
    new Point(41.533333, 2.45, "6/2/2017 1:59:30"),
    new Point(41.7, 2.833333, "3/2/2017 1:59:30")
];
*/
var selected_date = new Date("January 1, 2017");
var shown = [];
var boot = true;

function Date_Comparator(Point1, Point2) {
    if (Point1.time.getTime() < Point2.time.getTime()) return 1;
    if (Point1.time.getTime() > Point2.time.getTime()) return -1;
    return 0;
}

function candiDate(s){ selected_date = new Date(s); }

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: {
            lat: 41.23,
            lng: 2.11
        }
    });
    get_from_database(boot);
    if (!boot){
        window.location.reload();
    }
}

function get_from_database(boot){
    var iframe = document.createElement('iframe');
    iframe.style="display: none;";
    iframe.src="/database.txt";
    iframe.id="database";
    document.body.appendChild(iframe);
    var rawtxt = $('#database').contents().find('html').find('body').find('pre').text();
    console.log(rawtxt);
    iframe.parentNode.removeChild(iframe);
    var lines = rawtxt.split("\n");
    for (var i = 0; i < lines.length; i++){
        if (lines[i] != "") {
            newEmergencyHandler(lines[i], boot);
        }
    }
    if (!boot){
        window.location.reload();
    }
    emergencies = emergencies.sort(Date_Comparator);
    console.log(emergencies);
    setMarkers();
}

function newEmergencyHandler(data_string, boot){
    var lon_lat_time = data_string.split(";");
    var new_emergency = new Point(
        parseFloat(lon_lat_time[0]),
        parseFloat(lon_lat_time[1]),
        lon_lat_time[2]);
    var add = true;
    for (var i = 0; i < emergencies.length; i++){
        add = (emergencies[i].lat != new_emergency.lat) || (emergencies[i].lng != new_emergency.lng);
        if (!(add)){
            break;
        }
    }
    if(add){
        emergencies.push(new_emergency);
    }
}

function setMarkers() {
    for (var i = 0; i < emergencies.length; i++) {
        var emergency = emergencies[i];
        if ((emergency.time.getTime() > selected_date.getTime())) {
            if (shown.indexOf(emergency) == -1){
                emergency.show(map, i);
                shown.push(emergency);
                for(var j = 0; j < shown.length ; j++){
                    google.maps.event.addListener(shown[j].marker, 'click', function () {
                        map.panTo(this.getPosition());
                        if(map.getZoom() < 11){
                            map.setZoom(11);
                        }
                    });
                }
            }
        }else{
            emergency.marker.setMap(null);
            emergency.marker = null;
            shown.splice(shown.indexOf(emergency),1);
        }
    }
}
