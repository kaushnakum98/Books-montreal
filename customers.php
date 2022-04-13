<?php
/*
#Revision history:
#
24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/



//this class is the plural class customers which is extended from its parent class collection using inheritance

require_once('customer.php');
require_once('database-connection.php');
require_once('collection.php');

//inhering from super class
class customers extends collection
{
    //class constructor that will get all the customers data
    function __construct()
    {
        try {
            //using global variable connection
            global $connection;

            //creating sql for calling SP customers_all()
            $sql = "CALL customers_all()";

            // prepare the connection
            $stmt = $connection->prepare($sql);

            //executing the statement
            $stmt->execute();

            //using while loop to iterate through all the data and we are using fetch_style PDO::FETCH_ASSOC so that it will behave like associative array
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //generating object from current row (one customer)
                $customer = new customer(($row['username']), ($row['password']), ($row['firstname']), ($row['lastname']), ($row['address']), ($row['city']), ($row['province']), ($row['postalcode']));
                // adding into local collection using parent class method add.
                $this->add(($row['username']), $customer);
            }
        } catch (Exception $e) {
            echo "Exception occurred: " . $e->getMessage();
        }
    }

}

