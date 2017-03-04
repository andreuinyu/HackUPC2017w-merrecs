var Point = function(lat, lng, time){
    this.lat = lat;
    this.lng = lng;
    this.time = string2date(time);

    this.show = function(map, index){
        var marker = new google.maps.Marker({
            map: map,
            draggable: false,
            optimized: false,
            zIndex: index,
            animation: google.maps.Animation.DROP,
            position: {
                lat: this.lat,
                lng: this.lng
            },
            icon: 'point_animation.gif'
        });
    };
}

function string2date(s) {
    //s is a string that contains the date in format 4/2/2017 1:59:30
    var d = new Date();
    var date_hour = s.split(" ");
    var date = date_hour[0].split("/");
    var hour = date_hour[1].split(":");
    d.setDate(parseInt(date[0]));
    console.log(date[1]);
    d.setMonth(parseInt(date[1]));
    d.setFullYear(parseInt(date[2]));
    d.setHours(parseInt(hour[0]));
    d.setMinutes(parseInt(hour[1]));
    d.setSeconds(parseInt(hour[2]));
    return d;
}