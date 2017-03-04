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


    $file = "./database.txt";
    $fh = fopen($file,'w+');

    // string to put username and passwords
    $entry = '';
    while(!feof($fh)) {
        // check for empty indexes
        if (!empty($data_in)) {

            $entry .= $data_in;
            $entry .= "\r\n";
         }
    }

    // using file_put_contents() instead of fwrite()
    file_put_contents('./database.txt', $entry);

    fclose($fh);
  }
  fclose($socket);
}
?>
