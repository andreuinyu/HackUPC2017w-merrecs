<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon"
          type="image/gif"
          href="point_animation.gif">
    <title>People in need of help</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #map {
            height: 100%;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','arial';
            line-height: 30px;
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

<script language="javascript" type="text/javascript" src="point.js"></script>
<script language="javascript" type="text/javascript" src="main.js"></script>


<?php
$socket = stream_socket_server("tcp://0.0.0.0:5354", $errno, $errstr);
if (!$socket) {
  echo "$errstr ($errno)<br />\n";
} else {
  while ($conn = stream_socket_accept($socket)) {
    $data_in = fread($conn,50);
    fwrite($conn, 'La fecha y hora actuales es ' . date('n/j/Y g:i a') . "\n");
    fclose($conn);
    /*
    echo"<script type='text/javascript'>
        newEmergencyHandler('<?php Print($data_in); ?>');
        </script>"
    */
     echo "<script type='text/javascript'>',
     'newEmergencyHandler("$data_in");',
     '</script>"
  }
  fclose($socket);
}
?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAVldevQ9URKGx2yxZ4or9YdBtdnmkjh8&callback=initMap&language=en">
</script>
</body>
</html>
