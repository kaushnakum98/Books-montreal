<?php
/*
#Revision history:
#
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
19 Rahul on 11/18/2020 at 4:23 AM Rahul Pipaliya(2012728) 2020-12-18 added session for login/signup page and its functionalities

*/



//singular class product
class product
{
    //private fields to hold the data of product
    private string $productId;
    private string $product_code;
    private string $description;
    private int $price;
    private string $costPrice;

    //constructor for products with optional parameters that will instantiates the class object
    function __construct($productId = "", $product_code = "", $description = "", $price = "", $costPrice = "")
    {
        if (mb_strlen($product_code) >= 1) {
            $this->productId = $productId;
            $this->product_code = $product_code;
            $this->costPrice = $costPrice;
            $this->description = $description;
            $this->price = $price;
        }
    }


    //getter and setter methods for private fields ..setter method will also check for validation..
    function getProductId()
    {
        return $this->productId;
    }

    function getProductCode()
    {
        return $this->product_code;
    }

    function setProductCode($id)
    {
        if ($this->validateProductId($id) == true) {
            $this->productId = $id;
        } else {
            return "Maximum Product id Length is " . PRODUCT_CODE_MAX_LENGTH;
        }
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDescription($desc)
    {
        if ($this->validateProductDesc($desc) == true) {
            $this->description = $desc;
        } else {
            return "Maximum Description Length is " . PRODUCT_DESCRIPTION_MAX_LENGTH;
        }
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        if ($this->validateProductPrice($price)) {
            $this->price = $price;
        } else {
            return "Maximum Price is " . PRODUCT_PRICE_MAX;
        }
    }

    function getCostPrice()
    {
        return $this->costPrice;
    }

    function setCostPrice($price)
    {
        $this->costPrice = $price;
    }

    //validation functions
    function validateProductPrice($price)
    {
        return (strlen($price) <= CUSTOMER_USERNAME_MAX_LENGTH);
    }

    function validateProductId($productId)
    {
        return (strlen($productId) <= CUSTOMER_USERNAME_MAX_LENGTH);
    }

    function validateProductDesc($desc)
    {
        return (strlen($desc) <= CUSTOMER_USERNAME_MAX_LENGTH);
    }

    //load function will return all the products
    function load()
    {
        try {
            global $connection;
            $stmt = $connection->prepare("CALL products_select()");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }

    //this function will add/update products using SP call
    function save()
    {
        try {
            global $connection;
            //check if product data exist , if yes then save it into $productDataIfExists , it will hold bool(false) if no data found
            $productDataIfExists = isProductExist($this->getProductCode());
            //if it found the data , that means we have it in already , so making sql statement that will call products_update  sp
            //if data is not found then we insert the data by making sql that will call products_insert sp
            if ($productDataIfExists !== false) {
                #update
                $sql = "CALL products_update(:id , :description, :price, :costPrice)";
            } else {
                #insert
                $sql = "CALL products_insert(:id , :description, :price, :costPrice)";
            }

            // adding the current values from fields to local variables..

            $productId = $this->getProductCode();
            $description = $this->getDescription();
            $price = $this->getPrice();
            $costPrice = $this->getCostPrice();

            //preparing the statement using prepare function
            $stmt = $connection->prepare($sql);

            //binding the parameters into sql using local appropriate fields
            $stmt->bindParam(':id', $productId);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':costPrice', $costPrice);

            //if execution is successful it will return true else false.. because execute function will return bool

            return $stmt->execute();
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }
    }


    //to remove customer from database this will call customers_delete SP
    function delete()
    {
        try {
            global $connection;

            $sql = "CALL products_delete(:productId)";

            // adding the current values from fields to local variables..
            $prodId = $this->getProductCode();

            //preparing the statement using prepare function
            $stmt = $connection->prepare($sql);

            //binding the parameters into sql using local appropriate fields
            $stmt->bindParam(':productId', $prodId);

            //if execution is successful it will return true else false.. because execute function will return bool
            return $stmt->execute();
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }


}