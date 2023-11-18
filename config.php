<?php
     $host        = "host = ";
     $port        = "port = ";
     $dbname      = "dbname = ";
     $credentials = "user = ";
        
     // Connecting, selecting database
     $dbconn = pg_connect( "$host $port $dbname $credentials"  ) or die('Could not connect: ' . pg_last_error());
?>