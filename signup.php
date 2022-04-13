<?Php
/*
#Revision history:
#
24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page
19 Rahul on 11/18/2020 at 4:23 AM Rahul Pipaliya(2012728) 2020-12-18 added session for login/signup page and its functionalities
17 Rahul on 11/17/2020 at 2:14 AM Rahul Pipaliya(2012728) 2020-12-17 added login/signup page and its functionalities
*/
//include common functions ,header , display title & subtitles
require_once('Functions/commonFunctions.php');
pageHeader('Registration');
require_once('customer.php');
enableLogging();

//using variable to store the data and also errors if it has any to show to the user.
$firstName = $lastName = $address = $city = $province = $postalCode = $userName = $passWord = "";
$firstNameErr = $lastNameErr = $addressErr = $cityErr = $provinceErr = $postalCodeErr = $userNameErr = $passWordErr = "";

//setting the title of the form and name of the button
$formHeader = 'Create Account';
$buttonName = 'Register';

//we can be redirected this page from account page also so it will check if there is session variable named updateMode and if it is there then if its true
if (isset($_SESSION['updateMode']) && $_SESSION['updateMode'] === true) {

    //by true it means that we have came from accounts.php page to update the value..
    //so setting $mode to update
    $mode = 'update';

    //changing the form header name and button name
    $formHeader = "Update Account";
    $buttonName = 'Update';


    //creating the class objects
    $user = new customer();

    //setting the data in the local variable to retain the data into the input fields
    if ($user->load_customer($_SESSION['userid'])) {
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $address = $user->getAddress();
        $city = $user->getCity();
        $province = $user->getProvince();
        $postalCode = $user->getPostalcode();
        $userName = $user->getUsername();
        $passWord = "";
    }
} else {
    $mode = 'insert';
}

//if the Register/Update Button is clicked..
if (isset($_POST["Register"])) {

    //first it will check for the errors it it has empty or length error it will store it into error variable and show it to user in red text under the input box
    //if there is no error then we will save it into data variables but before that we check and remove possible malicious data
    if (empty($_POST["firstname"])) {
        $firstNameErr = "firstname Cannot be empty";
    } else if (mb_strlen($_POST["firstname"]) > CUSTOMER_NAME_MAX_LENGTH) {
        $firstNameErr = "Maximum Length of firstname is " . CUSTOMER_NAME_MAX_LENGTH;
    } else {
        $firstName = removeInjection($_POST["firstname"]);
    }

    //last name is optional
    if (isset($_POST["lastname"]) && !empty($_POST["lastname"])) {
        if (mb_strlen($_POST["lastname"]) > CUSTOMER_NAME_MAX_LENGTH) {
            $lastNameErr = "Maximum Length of lastname is " . CUSTOMER_NAME_MAX_LENGTH;
        } else {
            $lastName = removeInjection($_POST["lastname"]);
        }
    }


    if (empty($_POST["address"])) {
        $addressErr = "address Cannot be empty";
    } else if (mb_strlen($_POST["address"]) > CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH) {
        $addressErr = "Maximum Length of address is " . CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH;
    } else {
        $address = removeInjection($_POST["address"]);
    }

    if (empty($_POST["city"])) {
        $cityErr = "city Cannot be empty";
    } else if (mb_strlen($_POST["city"]) > CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH) {
        $cityErr = "Maximum Length of city is " . CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH;
    } else {
        $city = removeInjection($_POST["city"]);
    }

    if (empty($_POST["province"])) {
        $provinceErr = "province Cannot be empty";
    } else if (mb_strlen($_POST["province"]) > CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH) {
        $provinceErr = "Maximum Length of province is " . CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH;
    } else {
        $province = removeInjection($_POST["province"]);
    }

    if (empty($_POST["postalcode"])) {
        $postalCodeErr = "postalcode Cannot be empty";
    } else if (mb_strlen($_POST["postalcode"]) > CUSTOMER_POSTAL_CODE_MAX_LENGTH) {
        $postalCodeErr = "Maximum Length of postalcode is " . CUSTOMER_POSTAL_CODE_MAX_LENGTH;
    } else {
        $postalCode = removeInjection($_POST["postalcode"]);
    }


    if (empty($_POST["username"])) {
        $userNameErr = "Username Cannot be empty";
    } else if (mb_strlen($_POST["username"]) > CUSTOMER_USERNAME_MAX_LENGTH) {
        $userNameErr = "Maximum Length of username is " . CUSTOMER_USERNAME_MAX_LENGTH;
    } else {
        $userName = removeInjection($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passWordErr = "password Cannot be empty";
    } else if (mb_strlen($_POST["password"]) > CUSTOMER_PASSWORD_MAX_LENGTH) {
        $passWordErr = "Maximum Length of password is " . CUSTOMER_PASSWORD_MAX_LENGTH;
    } else {
        $passWord = removeInjection($_POST["password"]);
    }

    //if there is no error then we have to update / insert the data into database using stored procedure call
    if (empty($firstNameErr) && empty($lastNameErr) && empty($addressErr) && empty($cityErr) && empty($provinceErr) && empty($postalCodeErr) && empty($userNameErr) && empty($passWordErr)) {
        //creating the customer object
        $customer = new customer($userName, $passWord, $firstName, $lastName, $address, $city, $postalCode, $province);
        if ($mode === 'insert') {
            // if mode is insert then we have to check if that username exist already in db
            // if it exist then this chunk of code will redirect user to the same page showing message 'Username is taken 'to the user
            if (isUsernameExist($userName) !== false) {
                header("location: signup.php?error=usernameTaken");
                exit();
            }

            //else save the data into db , if its successful then redirect user to login page
            if ($customer->save() === true) {
                echo "<script>alert('Registration Complete, You May login!')</script>";
                header("location: login.php");
                exit();
            }
        } else if ($mode === 'update') {
            //if the mode is update
            //update the data into db , if its successful then redirect user to home page
            if ($customer->updateCustomer($_SESSION['userid'], $customer) == true) {
                echo "<script>alert('Successfully Updated!')</script>";
                header("location: index.php");
                exit();
            }
        }

    }
}

?>
    <div class="center">
        <form class="signup" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
            <?php echo "<h1>$formHeader</h1>"; ?>
            <?php
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == "emptyInput") {
                    echo "<h2>Fill In all the field!</h2>";
                }
                if ($error == "invalidUid") {
                    echo "<h2>user name is not valid</h2>";
                }
                if ($error == "usernameTaken") {
                    echo "<h2>Sorry Username is already taken</h2>";
                }
                if ($error == "none") {
                    echo "<h2>Congratssss, you have signed up!</h2>";
                }
            }
            ?>
            <?php
            if ($mode == 'insert') {
                echo "<h2>Already have an account? <span><a href=login.php>Sign in</a> </span></h2>";
            }
            ?>

            <div class="signup__field">
                <input class="signup__input" type="text" value="<?php echo $firstName; ?>" name="firstname"
                       id="firstname"/>
                <label class="signup__label" for="firstname">First Name</label>
                <span class="error"><?php echo $firstNameErr; ?></span>
            </div>
            <div class="signup__field">
                <input class="signup__input" type="text" value="<?php echo $lastName; ?>" name="lastname"
                       id="lastname"/>
                <label class="signup__label" for="lastname">Last Name</label>
                <span class="error"><?php echo $lastNameErr; ?></span>
            </div>


            <div class="signup__field">
                <input class="signup__input" type="text" value="<?php echo $address; ?>" name="address" id="address"/>
                <label class="signup__label" for="address">Address</label>
                <span class="error"><?php echo $addressErr; ?></span>
            </div>
            <div class="signup__field">
                <input class="signup__input" type="text" value="<?php echo $city; ?>" name="city" id="city"/>
                <label class="signup__label" for="city">City</label>
                <span class="error"><?php echo $cityErr; ?></span>
            </div>
            <div class="signup__field">
                <input class="signup__input" type="text" value="<?php echo $province; ?>" name="province"
                       id="province"/>
                <label class="signup__label" for="province">Province</label>
                <span class="error"><?php echo $provinceErr; ?></span>
            </div>

            <div class="signup__field">
                <input class="signup__input" type="text" value="<?php echo $postalCode; ?>" name="postalcode"
                       id="postalcode"/>
                <label class="signup__label" for="postalcode">Postal Code</label>
                <span class="error"><?php echo $postalCodeErr; ?></span>
            </div>
            <div class="signup__field">
                <input class='signup__input' type='text' value='<?php echo $userName; ?>' name='username'
                       id='username'/>
                <label class='signup__label' for='username'>Username</label>
                <span class="error"><?php echo $userNameErr; ?></span>
            </div>

            <div class="signup__field">
                <input class="signup__input" type="password" value="<?php echo $passWord; ?>" name="password"
                       id="password"/>
                <label class="signup__label" for="password">Password</label>
                <span class="error"><?php echo $passWordErr; ?></span>
            </div>

            <button name='Register'><?php echo $buttonName; ?></button>
        </form>
    </div>

    <!--display page footer-->
<?php

pageFooter();
?>