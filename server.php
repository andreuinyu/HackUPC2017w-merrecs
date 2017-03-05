<?php
$socket = stream_socket_server("tcp://0.0.0.0:5354", $errno, $errstr);
if (!$socket) {
  echo "$errstr ($errno)<br />\n";
} else {
  while ($conn = stream_socket_accept($socket)) {
    $data_in = fread($conn,50);
    fwrite($conn, 'Your emergency request has been received at ' . date('n/j/Y g:i a') . "\n");
    fclose($conn);

    $file = "./database.txt";

    // string to put username and passwords
    $entry = '';// file_get_contents($file);
    // check for empty indexes
    if (!empty($data_in)) {

        $entry .= $data_in;
        $entry .= "\r\n";
        // using file_put_contents() instead of fwrite()
        file_put_contents($file, $entry, FILE_APPEND);
     }
  }
  fclose($socket);
}
?>
