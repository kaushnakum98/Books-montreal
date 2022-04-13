<?php
/*
#Revision history:
#
26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-11 added delete purchase code.

*/




//import purchase class
require_once('purchase.php');

//if purchase id in post request has been received
if (isset($_POST['purchaseId'])) {
    $purchaseId = $_POST['purchaseId']; // save the post id in variable
    $purchase = new purchase(); // create an object of the class

    //id deletion is successful then show the message
    if ($purchase->delete($purchaseId)) {
        echo "<h1>Purchase has been deleted! thank you!</h1>";
    }else{
        echo "<h1>Server Error , Please Try Again!</h1>";
    }
}
