<?php
/*
#Revision history:
#
26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/




require_once("database-connection.php");
require_once("Functions/commonFunctions.php");

//singular class purchase
class purchase
{
    //private fields to hold the data of purchase
    private $purchaseId;
    private $productId;
    private $username;
    private $quantity;
    private $comments;

    //private objects
    private $person;
    private $product;

    //constructor for purchase with optional parameters that will instantiates the class object
    function __construct($productId = "", $quantity="", $comments = "", $person = "", $product = "")
    {
        if (mb_strlen($productId) >= 1) {
            $this->productId = $productId;
            $this->quantity = $quantity;
            $this->comments = $comments;
            $this->username = $_SESSION["userid"];
            //this part will set the private objects ..this will come handy when getting the extra info about the purchase
            if (!empty($person) && !empty($product)) {
                $this->person = $person;
                $this->product = $product;
                $this->purchaseId = $product->purchase_id;
            }
        }
    }

    //getter and setter methods for private fields ..setter method will also check for validation..
    //extracting the info from the objects in some of the functions .
    function getUsername()
    {
        return $this->username;
    }

    function getProductId()
    {
        return $this->productId;
    }

    function setProductId($id)
    {
        $this->productId = $id;
    }

    function getComments()
    {
        return $this->comments;
    }

    function setComments($comments)
    {
        $this->comments = $comments;
    }


    function getPurchaseId()
    {
        return $this->purchaseId;
    }

    function setPurchaseId($id)
    {
        $this->purchaseId = $id;
    }

    function setQty($qty)
    {
        $this->quantity = $qty;
    }

    function getFirstName()
    {
        return $this->person->firstName;
    }

    function getLastName()
    {
        return $this->person->lastName;
    }

    function getCity()
    {
        return $this->person->city;
    }

    function getGrandTotal()
    {
        return $this->getSubtotal() + $this->getTaxes();
    }

    function getSubtotal()
    {
        return $this->getPrice() * $this->getQty();
    }

    function getPrice()
    {
        return $this->product->price;
    }

    function getQty()
    {
        return $this->quantity;
    }

    function getTaxes()
    {
        return $this->getSubtotal() * TAX_RATE;
    }



    //load function will return all the products
    function load_purchases($username)
    {
        try {
            global $connection;
            $stmt = $connection->prepare("CALL purchases_select(:username)");
//            $username = $this->getUsername();
            $stmt->bindParam(':username', $username);
            if($stmt->execute()){
                $this->setPurchaseId();
                $this->setQty();
                $this->setComments();
                $this->setProductId();
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }



    //this function will add/update purchase using SP call
    function save()
    {
        try {
            //using the global variable connection
            global $connection;

            //generation the sql for purchases_insert sp with parameters
            $sql = "CALL purchases_insert(:productId, :userId, :qty, :comments , :subtotal , :taxes_amount, :grand_total)";

            //getting the data into local variables
            $productId = $this->getProductId();
            $userId = $this->getUsername();
            $qty = $this->getQty();
            $comments = $this->getComments();

            //getting the price from the db using sp call product_select and getting subtotal using multiplying price * quantity
            $subTotal = intval(isProductExist($productId)['price']) * intval($qty);

            //getting taxed amount , current tax rate is 15.2% so the tax multiplier is 15.2/100 which is 0.152 , is coming from the constant
            $taxedAmount = $subTotal * TAX_RATE;

            //summing subtotal + taxed amount into grand total
            $grandTotal = $subTotal + $taxedAmount;

            //preparing the connection for execution
            $stmt = $connection->prepare($sql);

            //binding the parameters to the values.
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':comments', $comments);
            $stmt->bindParam(':subtotal', $subTotal);
            $stmt->bindParam(':taxes_amount', $taxedAmount);
            $stmt->bindParam(':grand_total', $grandTotal);

            //executing and returning the status of the execution of sql
            return $stmt->execute();
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }
    }



    //this function will call sp purchases_delete to delete the record of purchase
    function delete($purchase_uuid)
    {
        try {
            //using the global variable connection
            global $connection;

            //generating the sql for purchases_delete sp with parameters
            $sql = "CALL purchases_delete(:id)";

            //getting the data into local variables
//            $purchaseId = $this->getPurchaseId();
            $purchaseId = $purchase_uuid;
            //preparing the connection for execution
            $stmt = $connection->prepare($sql);

            //binding the parameters to the values.
            $stmt->bindParam(':id', $purchaseId);

            //executing and returning the status of the execution of sql
            return $stmt->execute();

        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }



}