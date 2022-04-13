<?php
/*
#Revision history:
#
24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/




//this class is the plural class purchases which is extended from its parent class collection using inheritance
require_once('purchase.php');
require_once('database-connection.php');
require_once('collection.php');

//inhering from super class
class purchases extends collection
{
    //class constructor that will get all the customers data
    function __construct($date = '')
    {
        try {
            //checking if the user is logged in
            if (isset($_SESSION['userid'])) {
                if (mb_strlen($date) === 0) {
                    $date = null;
                }

                //using global variable connection
                global $connection;

                //creating sql statement which will call SP filter_purchases
                $sql = "CALL filter_purchases(:date , :userId)";

                //preparing the connection for execution
                $stmt = $connection->prepare($sql);

                //binding the parameters
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':userId', $_SESSION['userid']);

                //executing the statement
                $stmt->execute();

                //iterating over the results , used fetch_style PDO::FETCH_ASSOC so that results will be associative array making iterable
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //creating object of array and adding the values for person and product
                    $person = (object)array('firstName' => trim($row['firstname']),
                        'lastName' => trim($row['lastname']),
                        'city' => trim($row['city']));
                    $product = (object)array('price' => trim($row['price']), 'purchase_id' => trim($row['purchase_id']));

                    //creating object of class purchase
                    $purchase = new purchase($row['product_code'], $row['quantity'], $row['comments'], $person, $product);

                    //adding that class object into local collection , using parent classes add method
                    $this->add(($row['purchase_id']), $purchase);
                }
            }
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }

}





