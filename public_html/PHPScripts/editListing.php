<?php
    session_start();
    include 'errorMessage.php';
    include 'getListingSummary.php';
    $connection = OpenCon();
    $user = $_SESSION['username'];
    $oldMLS = $_POST['oldMLS'];
    $listingMLSNumber = $_POST['MLSnumber'];
    $mlsNum = $listingMLSNumber;
    $listingDetailPath = "detailed_listing.php?number=" . $mlsNum;
    $listingdescription = $_POST['description'];
    $listingdwellingType = $_POST['dwellingType'];
    $listingPrice = $_POST['price'];
    $rooms = array(); //initialize empty array for the rooms

    $roomCount = count($_POST['type']);
    for($i = 0; $i < $roomCount; $i++){
        $rooms[$i]['type'] = $_POST['type'][$i];
        $rooms[$i]['features'] = $_POST['features'][$i];
        $rooms[$i]['area'] = $_POST['area1'][$i];
        $rooms[$i]['length'] = $_POST['length'][$i];
    }

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
    $listingArmCode = $_POST['armCode'];
    $listingDisarmCode = $_POST['disarmCode'];
    $listingPassCode = $_POST['passCode'];
    $listingAlarmNotes = $_POST['alarmNotes'];
    $listingLockCode = $_POST['lockCode'];
    $listingOccupied = $_POST['occupied'];

    

    $imageDirectory = '../img/';


    /*SINCE WE REMOVED THE OPTION TO ENTER THE AGENCY
    * WE MUST FIGURE OUT WHAT THE AGENCY IS BEFORE WE SUBMIT THIS POST
    * THE EASIEST WAY I CAN THINK OF IS WITH AN SQL QUERY TO RETURN IT
    */
    
    $statement = $connection->prepare("UPDATE `Listing` SET `MLSNumber`='$listingMLSNumber', `street`=?, `city`=?, `state`='$listingstate', `zip`='$listingzip', 
        `area`='$listingarea', `detailPath`='$listingDetailPath', `description`=?, `lotSize`='$listinglotSize', `dwellingType`='$listingdwellingType', `subdivision`=?, `elemSchoolDisctrict`=?,
        `midSchoolDistrict`=?, `highSchoolDistrict`=?, `fencing`='$listingfencing', `detachedGarage`='$listingdetachedGarage', `lastEditDatetime`=CURRENT_TIMESTAMP WHERE `MLSNumber`='$oldMLS'");
    
    $statement->bind_param("sssssss", $listingstreet, $listingcity, $listingdescription, $listingsubdivision, $listingelemSchoolDistrict, $listingmidSchoolDistrict, $listinghighSchoolDistrict);
    
    //Now we need to make sure that the query worked

    if(!$statement->execute()){ //statement is actually executed HERE
        setMessage("There was an error editing the listing in the database.<br>" . $connection->error);
        header("Location: ../edit_listing.php");
        die;
    }

    $unsoldStatement = $connection->prepare("UPDATE `UnsoldListing` SET `armCode`='$listingArmCode', `disarmCode`='$listingDisarmCode', `passcode`='$listingPassCode', `alarmNotes`='$listingAlarmNotes',
        `occupied`='$listingOccupied', `lockboxCode`='$listingLockCode' WHERE `MLSNumber`=$mlsNum");

    $unsoldStatement->execute();

    if($listingPrice != str_replace(',', '', getPrice($mlsNum))) {
        $result = $connection->query("INSERT INTO `ListingPrice` (`MLSNumber`, `changedDatetime`, `price`) VALUES ('$mlsNum', CURRENT_TIMESTAMP, '$listingPrice')");
    }

    // Delete the old rooms
    $connection->query("DELETE FROM `Room` WHERE `MLSNumber`='$mlsNum'");

    //Next, add the rooms
    $counter = 0;
    for($i=0;$i<$roomCount;$i++){
        $type = $rooms[$i]['type'];
        $features = $rooms[$i]['features'];
        $area = $rooms[$i]['area'];
        $length = $rooms[$i]['length'];
        $statement = $connection->prepare("INSERT INTO `Room` (`MLSNumber`, `type`, `features`, `area`, `length`) VALUES ('$mlsNum', ?, ?, '$area', '$length')");
        $statement->bind_param("ss", $type, $features);
        if(!$statement->execute()){
            setMessage("Room insertion error:<br>" . $connection->error);
            header("Location: ../edit_listing.php");
            die;
        }
    }
    if(isset($_POST['removedPhotos'])) {
        $removedPhotoCount = count($_POST['removedPhotos']);
        for($i = 0; $i < $removedPhotoCount; $i++){
            $thisPath = $_POST['removedPhotos'][$i];
            $connection->query("DELETE FROM `ListingPhoto` WHERE `MLSNumber`='$mlsNum' AND `photoPath`='$thisPath'");
        }
    }

    //Now, add the images that the user uploaded, if any

    for($i = 0; $i < count($_FILES['photoPath']['name']); $i++){
        if($_FILES['photoPath']['name'][$i] == "") {
            continue;
        }
        $uploadFile = $imageDirectory . basename($_FILES['photoPath']['name'][$i]);
        move_uploaded_file($_FILES['photoPath']['tmp_name'][$i], $uploadFile);
        //we've uploaded the file, now we need to upload the image reference to the database

        /**
         * QUICK FIX: remove the ../ from the image path so that the path is actually correct
         *              Going to do this by simply trimming the first 3 characters off of the string $uploadfile
         */
        
        $uploadFile = substr($uploadFile, 3);

        $result = $connection->query("INSERT INTO `ListingPhoto` (`photoPath`, `MLSNumber`) VALUES ('$uploadFile', '$mlsNum')");

        if($result == 1){
            $num = 1;
            while($result != 1){ //This will try to protect against duplicates
                $uploadFile = $imageDirectory . $num . basename($_FILES['photoPath']['name'][$i]);
                move_uploaded_file($_FILES['photoPath']['tmp_name'][$i], $uploadFile);
                $result = $connection->query("INSERT INTO `ListingPhoto` (`photoPath`, `MLSNumber`) VALUES ('$uploadFile', '$mlsNum')");
                $num++;
            }
        }
    }


    $result = $connection->query("SELECT photoPath FROM `ListingPhoto` WHERE `MLSNumber`='$mlsNum' LIMIT 1");
    $row = $result->fetch_assoc();
    $thumbnailPath = $row['photoPath'];
    $connection->query("UPDATE `Listing` SET `thumbnailPath`='$thumbnailPath' WHERE `MLSNumber`='$mlsNum'");

    CloseCon($connection);

    
    header("Location: ../index.php");

?>