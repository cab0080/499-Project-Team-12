<?php
    function OpenCon()
     {
     $dbhost = "162.241.224.47";
     $dbuser = "avgmzvmy_admin";
     $dbpass = "preston";
     $db = "avgmzvmy_WPQDF";
     $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

     return $conn;
     }
     
    function CloseCon($conn)
     {
     $conn -> close();
     }
?>