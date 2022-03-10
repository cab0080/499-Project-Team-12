<?php
    function OpenCon()
     {
     $dbhost = "localhost";
     $dbuser = "avgmzvmy_admin";
     $dbpass = "preston";
     $db = "avgmzvmy_WPQDF";
     $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

     return $conn;
     }
     
    function CloseCon($conn)
     {
     $conn -> close();
     }
?>