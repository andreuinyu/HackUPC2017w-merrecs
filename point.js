var Point = function(lat, lng, time){
    this.lat = lat;
    this.lng = lng;
    this.time = time;

    this.show = function(map){
        var marker = new google.maps.Marker({
            map: map,
            draggable: false,
            optimized: false,
            animation: google.maps.Animation.DROP,
            position: {lat: this.lat, lng: this.lng},
            icon: 'point_animation.gif'
        });
    };
}
