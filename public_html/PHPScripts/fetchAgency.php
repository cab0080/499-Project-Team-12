<?php
    //This is a PHP script that will return the current agency of a manager who is logged in
    //This will be used for the open/closed listing reports.
    session_start();
    include 'connect.php';

    $connection = OpenCon();
    $managerID = $_SESSION['username'];
    $agencyName = "";

    $sql ="SELECT agencyID FROM Agent WHERE username='$managerID' AND role='manager'";

    $result = $connection->query($sql);
    if($result->num_rows == 0){
        echo "Your username is " . $managerID;
    }
    else{
        $agencyName = $result->fetch_assoc()['agencyID'];
    }



    function getAgencyID(){
        $connection = OpenCon();
        $managerID = $_SESSION['username'];
        $agencyName = "";

        $sql ="SELECT agencyID FROM Agent WHERE username='$managerID' AND role='manager'";

        $result = $connection->query($sql);
        $ID = $result->fetch_assoc()['agencyID'];
        CloseCon($connection);
        return $ID;
    }

    function getAgencyName(){
        $agencyID = getAgencyID();
        $connection = OpenCon();
        $sql = "SELECT name FROM Agency WHERE agencyID='$agencyID'";
        $result = $connection->query($sql);
        $name = $result->fetch_assoc()['name'];
        return $name;
    }
    //SELECT DATEDIFF(CURRENT_DATE, postedDatetime) FROM Listing WHERE MLSNumber='123456789'
?>