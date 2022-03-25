<?php
    session_start();
    include 'connect.php';
    include 'errorMessage.php';
    $connection = OpenCon();
    $user = $_SESSION['username'];
    $listingMLSNumber = $_POST['MLSnumber'];
    $mlsNum = $listingMLSNumber;
    $listingDetailPath = "../detailInfo/" . $mlsNum;
    $listingdescription = $_POST['description'];
    $listingdwellingType = $_POST['dwellingType'];
    $listinglistingAgencyID = $_POST['listingAgencyID'];
    $listingPrice = $_POST['price'];
    $rooms = array(); //initialize empty array for the rooms

    /*For loop explanation:
        PHP should be recieving an array of inputs for each room.
        Each room will be sort of treated like its own form.
            Because for instance, there are two rooms, so there are two "type" names submitted with the form
        Each of these different room attributes will be an array
        Each of these arrays SHOULD have the same length
        So we will execute this loop as many times as there are elements in these arrays.
    */

    $roomCount = count($_POST['type']);
    for($i = 0; $i < $roomCount; $i++){
        $rooms[$i]['type'] = $_POST['type'][$i];
        $rooms[$i]['features'] = $_POST['features'][$i];
        $rooms[$i]['area'] = $_POST['area1'][$i];
        $rooms[$i]['length'] = $_POST['length'][$i];
    }

 ////**********TESTING AREA***********
    // $count = count($_POST['type']);
    // echo "the count is " . $count;
    // for($i = 0; $i<$count;$i++){
    //     echo "<br>This is room number " . $i;
    //     echo "<br>  Its type is " . $rooms[$i]['type'];
    //     echo "<br>  Its features are " . $rooms[$i]['features'];
    //     echo "<br>  Its area is " . $rooms[$i]['area'];
    //     echo "<br>  Its length is " . $rooms[$i]['length'];
        
    // }

    //Now we have an array of rooms. We will add them to the database after the property is there too

    $listingfencing = 0;
    if(!empty($_POST['fenced'])){
        $listingfencing = 1; //set fenced to true
    }
    
    $listingdetachedGarage = 0;
    if(!empty($_POST['detachedGarage'])){
        $listingdetachedGarage = 1; //set detachedGarage to true
    }

    $listinglotSize = $_POST['lotSize'];
    $listingarea = $_POST['area'];
    $listingstreet = $_POST['street'];
    $listingcity = $_POST['city'];
    $listingstate = $_POST['state'];
    $listingzip = $_POST['zip'];
    $listingsubdivision = $_POST['subdivision'];
    $listingelemSchoolDistrict = $_POST['elemSchoolDistrict'];
    $listingmidSchoolDistrict = $_POST['midSchoolDistrict'];
    $listinghighSchoolDistrict = $_POST['highSchoolDistrict'];
    

    $imageDirectory = '../img/';
    $thumbnailPath = $imageDirectory . basename($_FILES['photoPath']['name'][0]);
    
    

    //Now it's time to insert this thing into the database.
    //Big long SQL query:
    $result = $connection->query("INSERT INTO `Listing` (`MLSNumber`, `thumbnailPath`, `street`, `city`, `state`, `zip`, 
        `area`, `listingAgentUsername`, `listingAgencyID`, `detailPath`, `status`, `description`, `lotSize`, `dwellingType`, 
        `builtYear`, `subdivision`, `elemSchoolDisctrict`, `midSchoolDistrict`, `highSchoolDistrict`, `fencing`, `detachedGarage`, 
        `agentHitCount`, `visitorHitCount`, `shoppingAreas`, `postedDatetime`, `lastEditDatetime`)
         VALUES (
            '$listingMLSNumber', 
            '$thumbnailPath', 
            '$listingstreet', 
            '$listingcity', 
            '$listingstate', 
            '$listingzip', 
            '$listingarea', 
            '$user', 
            '$listinglistingAgencyID', 
            '$listingDetailPath', 
            'available', 
            '$listingdescription', 
            '$listinglotSize', 
            '$listingdwellingType', 
            NULL, 
            '$listingsubdivision', 
            '$listingelemSchoolDistrict', 
            '$listingmidSchoolDistrict', 
            '$listinghighSchoolDistrict', 
            '$listingfencing', 
            '$listingdetachedGarage', 
            '0', 
            '0', 
            NULL, 
            CURRENT_TIMESTAMP, 
            CURRENT_TIMESTAMP)
    ");

    //Now we need to make sure that the query worked

    if($result != 1){
        setMessage("There was an error adding the post to the database.<br>" . $connection->error);
        header("Location: ../add_listing.php");
        die;
    }

    //Add the price
    $result = $connection->query("INSERT INTO `ListingPrice` (`MLSNumber`, `changedDatetime`, `price`) VALUES ('$mlsNum', CURRENT_TIMESTAMP, '$listingPrice')");

    //Next, add the rooms
    $counter = 0;
    for($i=0;$i<$roomCount;$i++){
        $type = $rooms[$i]['type'];
        $features = $rooms[$i]['features'];
        $area = $rooms[$i]['area'];
        $length = $rooms[$i]['length'];
        $result = $connection->query("INSERT INTO `Room` (`MLSNumber`, `type`, `features`, `area`, `length`) VALUES ('$mlsNum', '$type', '$features', '$area', '$length')");
        if($result != 1){
            setMessage("Room insertion error:<br>" . $connection->error);
            header("Location: ../add_listing.php");
            die;
        }
    }

    //Now, add the images that the user uploaded, if any

    for($i = 0; $i < count($_FILES['photoPath']['name']); $i++){
        $uploadFile = $imageDirectory . basename($_FILES['photoPath']['name'][$i]);
        move_uploaded_file($_FILES['photoPath']['tmp_name'][$i], $uploadFile);
        //we've uploaded the file, now we need to upload the image reference to the database
        $result = $connection->query("INSERT INTO `ListingPhoto` (`photoPath`, `MLSNumber`) VALUES ('$uploadFile', '$mlsNum')");
        if($result == 0){
            setMessage("There was an error inserting the image to the database" . $connection->error);
            header("Location: ../add_listing.php");
            die;
        }
    }

    CloseCon($connection);

    
    header("Location: ../index.php");

?>