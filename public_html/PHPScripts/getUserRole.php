<?php 
    session_start();
    include 'connect.php';
    function getUserRole(){
        $username = $_SESSION['username'];
        $connection = OpenCon();
        $sql = "SELECT role FROM Agent WHERE username='$username'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        return $row['role'];
    }
?>