<?php
    session_start();
    //include 'connect.php';
    include 'getListingSummary.php';

    //This script will get the information from a form filled out by a user
    //and send it as an email to the listing agent of the property

    $listingNumber = $_SESSION['number'];
    $contactName = $_POST['buyerName'];
    $contactPhone = $_POST['buyerPhoneNumber'];
    $contactEmail = $_POST['buyerEmail'];
    $message = $_POST['message'];

    $agentEmail = returnAgentEmail($listingNumber);

    //The following string will contain the email body

    $emailText = "You have a showing request for property number " . $listingNumber . "\n" .
                "Requester's name: " . $contactName . "\n" .
                "Phone number:" . $contactPhone . "\n" .
                "Email address: " . $contactEmail . "\n" .
                "Message body: '" . $message . "'\n\n\n" . 
                "This message was sent automatically from tucasana.com. Please do not reply and instead contact the requester using the information that they provided.";


    //Now it's time to send the email:

    mail($agentEmail, "Tucasana: Showing Request", $emailText);

    echo "Your request has been sent to the listing agent. \nThank you.";
?>