/**
 * Created by andre on 03/03/2017.
 */
<<<<<<< HEAD

Function string2date(s) { //s is a string that contains the date in format dd/mm/yyyy hh:mm:ss
	var d =new Date();
	//4/2/2017 1:59:30
	var date_hour = s.split(" ");
	var date = date_hour[0].split("/");
	var hour = date_hour[1].split(":");
	d.setDay(parseInt(date[0]);
	d.setMonth(parseInt(date[1]);
	d.setYear(parseInt(date[2]);
	d.setHour(parseInt(hour[0]);
	d.setMinute(parseInt(hour[1]);
	d.setSeconds(parseInt(hour[2]);
	}
 
//  
 
class Point{
	constructor(lat, lng, time){
		
		this.lat = lat;
		this.lng = lng;
		this.time= data(time); 
		}
		
	show(){
		var marker = new google.maps.Marker({
            position: {lat: this.lat, lng: this.lng},
            map: map,
            zIndex: pupa[3],
            draggable: false,
		}	
	}
 
var Arrayarnos = [];

 
=======
>>>>>>> origin/master
var pupas = [
    new Point(41.492009, 2.362017, ""),
    new Point(41.555833, 2.4025,""),
    new Point(41.533333, 2.45,"")
];

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: 41.23, lng: 2.11}
    });
    setMarkers(map);
}

function setMarkers(map) {
    for (var i = 0; i < pupas.length; i++) {
        pupas[i].show(map);
    }
}