<?php
/*
#Revision history:
#
26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/





//importing the files starting the session for getting session variables,,
include_once('database-connection.php');
include_once 'purchases.php';
include_once 'purchase.php';
session_start();

//replacing '-' with / as in sp call i have set it up that way
$searchDate = str_replace('-', '/', $_POST["searchDate"]);

//getting all the data of purchases and saving it into local collection
$purchases = new purchases($searchDate);

//if the data is there then showing it using HTML table
if ($purchases->count() > 0) {
//    creating first row as static table headers
    echo "
        <table class='center'>
        <tr>
            <th></th>   
            <th>Product Code</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
            <th>Comments</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Taxes</th>
            <th>Grand Total</th>
        </tr>";

    //iterate through the collection to show it to the user , getting each values from object and show it into row one by one
//    foreach ($purchases->items as $purchase) {
//        echo "<tr>";
//        echo "<td> <button onclick='callFun();' name='deletePurchase' value=" . $purchase->getPurchaseId() . ">Delete</button></td>";
//        echo "<td>" . $purchase->getProductId() . "</td>";
//        echo "<td>" . $purchase->getFirstName() . "</td>";
//        echo "<td>" . $purchase->getLastName() . "</td>";
//        echo "<td>" . $purchase->getCity() . "</td>";
//        echo "<td>" . $purchase->getComments() . "</td>";
//        echo "<td>" . $purchase->getPrice() . "$" . "</td>";
//        echo "<td>" . $purchase->getQty() . "</td>";
//        echo "<td>" . $purchase->getSubtotal() . "$" . "</td>";
//        echo "<td>" . $purchase->getTaxes() . "$" . "</td>";
//        echo "<td>" . $purchase->getGrandTotal() . "$" . "</td>";
//    }
    foreach ($purchases->items as $purchase) {
        echo "<tr>
           <td> <button id = ".$purchase->getPurchaseId()." onclick='deletePurchase()' > Delete </button></td>   
            <td>".$purchase->getProductId()."</td>
             <td>".$purchase->getFirstName()."</td>
              <td>".$purchase->getLastName()."</td>
               <td>".$purchase->getCity()."</td>
                <td>".$purchase->getComments()."</td>
                 <td>".$purchase->getPrice()."$</td>
                  <td>".$purchase->getQty()."</td>
                   <td>".$purchase->getSubtotal()."$</td>
                    <td>".$purchase->getTaxes()."$</td>
                     <td>".$purchase->getGrandTotal()."$</td>

";

    }
    echo "</table>";
} else {
    echo "<h1>No purchases has been made on this date or later date , make one? </h1>";
}




