<!DOCTYPE html>
<html lang="en">
<head>
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
        <input id="date" value="2017-01-01" type="date" onchange="candiDate(this.value)"/>
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
<!--                                  -->
<?php
error_reporting(E_ALL);

/* Permitir al script esperar para conexiones. */
set_time_limit(0);

/* Activar el volcado de salida implícito, así veremos lo que estamos obteniendo
 * mientras llega. */
ob_implicit_flush();

$address = '35.157.36.8';
$port = 5354;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
}

if (socket_listen($sock, 5) === false) {
    echo "socket_listen() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
}

do {
    if (($msgsock = socket_accept($sock)) === false) {
        echo "socket_accept() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
        break;
    }
    /* Enviar instrucciones. */
    $msg = "\nBienvenido al Servidor De Prueba de PHP. \n" .
        "Para salir, escriba 'quit'. Para cerrar el servidor escriba 'shutdown'.\n";
    socket_write($msgsock, $msg, strlen($msg));

    do {
        if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
            echo "socket_read() falló: razón: " . socket_strerror(socket_last_error($msgsock)) . "\n";
            break 2;
        }
        if (!$buf = trim($buf)) {
            continue;
        }
        if ($buf == 'quit') {
            break;
        }
        if ($buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        $talkback = "PHP: Usted dijo '$buf'.\n";
        socket_write($msgsock, $talkback, strlen($talkback));
        echo "$buf\n";
    } while (true);
    socket_close($msgsock);
} while (true);

socket_close($sock);
?>
<!--                                                         -->
<script language="javascript" type="text/javascript" src="point.js"></script>
<script language="javascript" type="text/javascript" src="main.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAVldevQ9URKGx2yxZ4or9YdBtdnmkjh8&callback=initMap&language=en">
</script>
</body>
</html>
