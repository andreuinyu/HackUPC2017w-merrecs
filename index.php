<!DOCTYPE html>
<html lang="en">
<iframe id="database" src="/database.txt" style="display: none;"></iframe>
<head>
    <link rel="icon"
          type="image/gif"
          href="point_animation.gif">
    <title>Emergency Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #map {
            height: 100%;
        }
       #floating-panel {
            position: absolute;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            height: 100px;
			      width: 15%;
            top: 45px;
            left: 1%;
            z-index: 5;
            background-color: #fff;
			      font-family: 'Roboto','arial';
            padding: 5px;
            text-align: center;
            line-height: 25px;
            padding-left: 10px;
        }
        /* Fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="floating-panel">
    <p>
        Emergencies since
        <input id="date" type="date" value="2017-01-01" onchange="candiDate(this.value)"/>
        <input id="button" type="button" onclick="setMarkers()" value="Find" />
        <script>
            document.getElementById("date").addEventListener("keyup", function(event) {
                event.preventDefault();
                if (event.keyCode == 13) {
                    document.getElementById("button").click();
                }
            });
        </script>
    </p>
</div>
<div id="map"></div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="point.js"></script>
<script language="javascript" type="text/javascript" src="main.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAVldevQ9URKGx2yxZ4or9YdBtdnmkjh8&callback=initMap&language=en"></script>
<script>
var poll = function () {
    get_from_database();
    setTimeout(poll, 1000);
  };
  poll();
</script>

</body>
</html>
