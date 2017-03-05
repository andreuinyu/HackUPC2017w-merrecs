<?php
$socket = socket_create_listen("tcp://0.0.0.0:5354");
if (!$socket) {
  echo "error\n";
} else {
  while ($conn = socket_accept($socket)) {
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
