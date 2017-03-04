<?php
$socket = stream_socket_server("tcp://0.0.0.0:5354", $errno, $errstr);
if (!$socket) {
  echo "$errstr ($errno)<br />\n";
} else {
  while ($conn = stream_socket_accept($socket)) {
    $data_in = fread($conn,50);
    echo "<script type='text/javascript'>console.log(new Array());</script>";
    fwrite($conn, 'La fecha y hora actuales es ' . date('n/j/Y g:i a') . "\n");
    fclose($conn);
  }
  fclose($socket);
}
?>
