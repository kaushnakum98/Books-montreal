<?Php
/*
#Revision history:
#
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page
19 Rahul on 11/18/2020 at 4:23 AM Rahul Pipaliya(2012728) 2020-12-18 added session for login/signup page and its functionalities
18 Rahul on 11/17/2020 at 2:15 AM Rahul Pipaliya(2012728) 2020-12-17 added login/signup page and its functionalities
*/
//include common functions ,header , display title & subtitles
include 'Functions/commonFunctions.php';
pageHeader('Log In');
enableLogging();
require_once('customer.php');

//using variable to store the data and also errors if it has any to show to the user.
$userName = $passWord = "";
$userNameErr = $passWordErr = "";

//if user click on the login button
if (isset($_POST['login'])) {
    //first it will check for the errors it it has empty or length error it will store it into error variable and show it to user in red text under the input box
    //if there is no error then we will save it into data variables but before that we check and remove possible malicious data
    if (empty($_POST["username"])) {
        $userNameErr = "Username Cannot be empty";
    } else if (mb_strlen($_POST["username"]) > CUSTOMER_USERNAME_MAX_LENGTH) {
        $userNameErr = "Maximum Length of username is" . CUSTOMER_USERNAME_MAX_LENGTH;
    } else {
        $userName = removeInjection($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passWordErr = "Password Cannot be empty";
    } else if (mb_strlen($_POST["password"]) > CUSTOMER_PASSWORD_MAX_LENGTH) {
        $passWordErr = "Maximum Length of password is" . CUSTOMER_PASSWORD_MAX_LENGTH;
    } else {
        $passWord = removeInjection($_POST["password"]);
    }

    //if there is no error then the error fields will be empty..genius!
    if (empty($userNameErr) && empty($passWordErr)) {
        //create a new object for customer to use the login ..
        $person = new customer();

        //user login function to verify
        $person->login($userName, $passWord);
    }


}


?>
    <!--login form-->
    <div class="center">
        <form class="signup" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
            <h1>Login</h1>
            <?php
            // we will be redirecting to this page in case of wrong password , or if user does not exist so if we are here on this page with that params in url then show users that errors
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == "wrongLogin") {
                    echo "<h2>User Name Does not exist in the System</h2>";
                }
                if ($error == "wrongPassword") {
                    echo "<h2>Wrong Password , Please Try Again!</h2>";
                }

            }
            ?>
            <p><span class="error">* = required field</span></p>
            <div class="signup__field">
                <input class="signup__input" type="text" name="username" id="username" maxlength="12"/>
                <label class="signup__label" for="username">Username *</label>
                <!--                show error -->
                <span class="error"><?php echo $userNameErr; ?></span>
            </div>

            <div class="signup__field">
                <input class="signup__input" type="password" name="password" id="password" maxlength="255"/>
                <label class="signup__label" for="password">Password *</label>
                <!--                show error -->
                <span class="error"><?php echo $passWordErr; ?></span>
            </div>

            <button name="login">Log In</button>
            <button><a href="signup.php">Register</a></button>

        </form>
    </div>

    <!--display page footer-->
<?php
pageFooter();
?>