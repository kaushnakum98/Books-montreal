<?php
/*
#Revision history:

24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
23 Rahul on 12/8/2020 at 9:15 AM Rahul Pipaliya(2012728) 2020-12-08 added link to download cheat sheet
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/



//singular class
require_once("database-connection.php");
require_once("Functions/commonFunctions.php");

class customer
{

    // private fields to to hold the data
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $address;
    private $city;
    private $province;
    private $postalcode;

    //constructor for class
    function __construct($username = "", $password = "", $firstname = "", $lastname = "", $address = "", $city = "", $postalcode = "", $province = "")
    {
        if ($username != "") {
            $this->username = $username;
            $this->password = (password_hash($password, PASSWORD_DEFAULT));
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->address = $address;
            $this->province = $province;
            $this->postalcode = $postalcode;
            $this->city = $city;
        }
    }

    //getter and setter functions to get and set the values of private fields..
    //setter function will also validate the data
    function getUsername()
    {
        return $this->username;
    }

    function setUserName($name)
    {
        if ($this->validateUserId($name) == true) {
            $this->username = $name;
        } else {
            return "Maximum Username Length is " . CUSTOMER_USERNAME_MAX_LENGTH;
        }
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        if ($this->validatePassword($password) == true) {
            $this->password = $password;
        } else {
            return "Maximum Password Length is " . CUSTOMER_PASSWORD_MAX_LENGTH;
        }
    }

    function getFirstName()
    {
        return $this->firstname;
    }

    function setFirstName($name)
    {
        if ($this->validateName($name)) {
            $this->firstname = $name;
        } else {
            return "Maximum Length of first name is " . CUSTOMER_NAME_MAX_LENGTH;
        }
    }

    function getLastName()
    {
        return $this->lastname;
    }

    function setLastName($name)
    {
        if ($this->validateName($name)) {
            $this->lastname = $name;
        } else {
            return "Maximum Length of last name is " . CUSTOMER_NAME_MAX_LENGTH;
        }
    }

    function getAddress()
    {
        return $this->address;
    }

    function setAddress($addr)
    {
        if ($this->validateAddress($addr)) {
            $this->address = $addr;
        } else {
            return "Maximum Length of Address is " . CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH;
        }
    }

    function getCity()
    {
        return $this->city;
    }

    function setCity($city)
    {
        if ($this->validateAddress($city)) {
            $this->city = $city;
        } else {
            return "Maximum Length of City Name is " . CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH;
        }
    }

    function getProvince()
    {
        return $this->province;
    }

    function setProvince($province)
    {
        if ($this->validateAddress($province)) {
            $this->province = $province;
        } else {
            return "Maximum Length of Province is " . CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH;
        }
    }


    function getPostalcode()
    {
        return $this->postalcode;
    }

    function setPostalcode($postal)
    {
        if ($this->validatePostalCode($postal)) {
            $this->postalcode = $postal;
        } else {
            return "Maximum Length of Postalcode is " . CUSTOMER_POSTAL_CODE_MAX_LENGTH;
        }
    }


    // validation function for validating names , address , postalcode , userid. returns boolean True is its validated
    function validateName($name)
    {
        return (mb_strlen($name) <= CUSTOMER_NAME_MAX_LENGTH && mb_strlen($name) !== 0);
    }

    function validateAddress($address)
    {
        return (mb_strlen($address) <= CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH && mb_strlen($address) !== 0);
    }

    function validatePostalCode($postalCode)
    {
        return (mb_strlen($postalCode) <= CUSTOMER_POSTAL_CODE_MAX_LENGTH && mb_strlen($postalCode) !== 0);
    }

    function validatePassword($password)
    {
        return (mb_strlen($password) <= CUSTOMER_PASSWORD_MAX_LENGTH && mb_strlen($password) !== 0);
    }

    function validateUserId($userid)
    {
        return (mb_strlen($userid) <= CUSTOMER_USERNAME_MAX_LENGTH && mb_strlen($userid) !== 0);
    }


    // this function will take customers userid as a parameter and call the SP to get the information about the customer
    public function load_customer($userid)
    {
        try {
            global $connection;
            $stmt = $connection->prepare("CALL customers_select(:userid)");
            $stmt->bindParam(':userid', $userid);
            // if execution is successful then it will save all the data into private fields and return true
            if ($stmt->execute() === true) {
                $row = $stmt->fetch();
                $this->setUserName(($row['username']));
                $this->setFirstName(($row['firstname']));
                $this->setLastName(($row['lastname']));
                $this->setAddress(($row['address']));
                $this->setCity(($row['city']));
                $this->setProvince(($row['provience']));
                $this->setPostalcode(($row['postalcode']));
                $this->setPassword($row['password']);
                return true;
            }
            return false;
        } //catch exception
        catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }
    }

    //this function will do the insert/update using SP call
    public function save()
    {
        try {
            global $connection;
            //check if user data exist , if yes then save it into $userDataifExits , it will hold bool(false) if no data found
            $userDataifExits = isUsernameExist($this->getUsername());
            //if it found the data , that means we have it in already , so making sql statement that will call customers update sp
            //if data is not found then we insert the data by making sql that will call customer_insert sp
            if ($userDataifExits !== false) {
                #update
                $sql = "CALL customers_update(:username , :password, :firstname, :lastname, :address, :city, :province, :postalCode)";
            } else {
                #insert
                $sql = "CALL customer_insert(:username , :password, :firstname, :lastname, :address, :city, :province, :postalCode)";
            }

            // adding the current values from fields to local variables..
            $username = $this->getUsername();
            $password = $this->getPassword();
            $firstname = $this->getFirstName();
            $lastname = $this->getLastName();
            $address = $this->getAddress();
            $city = $this->getCity();
            $province = $this->getProvince();
            $postalCode = $this->getPostalcode();

            //preparing the statement using prepare function
            $stmt = $connection->prepare($sql);

            //binding the parameters into sql using local appropriate fields
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':province', $province);
            $stmt->bindParam(':postalCode', $postalCode);

            //if execution is successful it will return true else false.. because execute function will return bool
            return $stmt->execute();
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }

    //to remove customer from database this will call customers_delete SP
    public function delete()
    {
        try {
            global $connection;
            //generate sql
            $sql = "CALL customers_delete(:username)";
            // adding the current values from fields to local variables..
            $username = $this->getUsername();
            //preparing the statement using prepare function
            $stmt = $connection->prepare($sql);
            //binding the parameters into sql using local appropriate fields
            $stmt->bindParam(':username', $username);
            //if execution is successful it will return true else false.. because execte function will return bool
            return $stmt->execute();
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }
    }

    //this function is validation for user login .. will get username and password as parameters
    function login($userName, $password)
    {
        //get the user data from db
        $userData = isUsernameExist($userName);
        //if no userdata found redirect user to login page with "User Not Exist" message.
        if ($userData === false) {
            header("location: login.php?error=wrongLogin");
            exit();
        }

        // we will be reaching here @this part of code if we were not redirected to login page with error so no need to use else statement
        //using password_verify function we can verify hash it returns true / false according to the values it has been given
        //if password is not matched redirect user to login page with "Wrong Password" message.
        if (!password_verify($password, $userData['PASSWORD'])) {
            header("location: login.php?error=wrongPassword");
            exit();
        } else {
            //if password verified with the hash then start a session and store user info into session variables and redirect user to home page
            session_start();
            $_SESSION["userid"] = $userData['user_uuid'];
            $_SESSION["firstname"] = $userData['firstname'];
            $_SESSION["lastname"] = $userData['lastname'];
            $_SESSION["username"] = $userData['username'];
            $_SESSION['updateMode'] = false;
            header("location: index.php");
        }
    }

    //to update the  customer into database this will call customers_update SP
    function updateCustomer($user_uuid, $newCustomerData)
    {
        try {
            global $connection;

            // adding the current values from fields to local variables..
            $username = $newCustomerData->getUsername();
            $password = $newCustomerData->getPassword();
            $firstname = $newCustomerData->getFirstName();
            $lastname = $newCustomerData->getLastName();
            $address = $newCustomerData->getAddress();
            $city = $newCustomerData->getCity();
            $province = $newCustomerData->getProvince();
            $postalCode = $newCustomerData->getPostalcode();

            //generate sql

            $sql = "CALL customers_update(:userid, :username , :password, :firstname, :lastname, :address, :city, :province, :postalCode)";

            //preparing the statement using prepare function
            $stmt = $connection->prepare($sql);
            //binding the parameters into sql using local appropriate fields

            $stmt->bindParam(':userid', $user_uuid);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':province', $province);
            $stmt->bindParam(':postalCode', $postalCode);

            //if execution is successful it will return true else false.. because execte function will return bool

            return $stmt->execute();
        } catch (Exception $e) {
            echo 'Exception occurred: ' . $e->getMessage();
        }

    }


}

