<?php

/*
#Revision history:
#

//19 Rahul on 11/18/2020 at 4:23 AM Rahul Pipaliya(2012728) 2020-12-18 added session for login/signup page and its functionalities
//18 Rahul on 11/17/2020 at 2:15 AM Rahul Pipaliya(2012728) 2020-12-17 added login/signup page and its functionalities
//16 Rahul on 11/12/2020 at 4:33 PM Rahul Pipaliya(2012728) 2020-11-12 send UTF-8 HEADERS
//15 Rahul on 11/12/2020 at 4:31 PM Rahul Pipaliya(2012728) 2020-11-12 added constants
//14 Rahul on 10/30/2020 at 5:59 PM Rahul Pipaliya(2012728) 2020-10-30 added error logging..
//12 Rahul on 10/30/2020 at 2:32 PM Rahul Pipaliya(2012728) 30-10-2020 css fixed and added design to navbar..
//11 Rahul on 10/30/2020 at 12:43 AM Rahul Pipaliya(2012728) 30-10-2020 added function to check validations..
//10 Rahul on 10/29/2020 at 2:35 AM Rahul Pipaliya(2012728) 29-10-2020 removed extra code and added comments..
//9 Rahul on 10/28/2020 at 5:30 PM Rahul Pipaliya (2012728) 27-10-2020 added functionality to show orders in tabular format
//6 Rahul on 10/27/2020 at 11:15 PM Rahul Pipaliya(2012728) 27-10-2020 added functionality to save the orders into purchases.txt
//5 Rahul on 10/22/2020 at 10:39 AM Rahul Pipaliya(2012728) 22-10-2020 Created Orders page , cart page and  added functionalities and validations
//3 Rahul on 10/20/2020 at 3:45 PM Rahul Pipaliya  (2012728) 2020-10-20  removed products code
//2 Rahul on 10/4/2020 at 3:18 PM import init
*/
//constants

require_once('database-connection.php');
define("PATH_IMAGES", "Media/");
define("PATH_FUNCTIONS", "Functions/");
define("PICTURE_BOOK1", PATH_IMAGES . "book1.jpg");
define("PICTURE_BOOK2", PATH_IMAGES . "book2.jpg");
define("PICTURE_BOOK3", PATH_IMAGES . "book3.jpg");
define("PICTURE_BOOK4", PATH_IMAGES . "book4.jpg");
define("PICTURE_BOOK5", PATH_IMAGES . "book5.jpg");
define("PICTURE_BOOK6", PATH_IMAGES . "book6.jpg");
define("PICTURE_BOOK7", PATH_IMAGES . "book7.jpg");
define("PICTURE_BOOK8", PATH_IMAGES . "book8.jpg");
define("PICTURE_BOOK9", PATH_IMAGES . "book9.jpg");
define("PICTURE_BOOK10", PATH_IMAGES . "book10.jpg");
define("PICTURE_BOOK11", PATH_IMAGES . "book11.jpg");
define("PICTURE_BOOK12", PATH_IMAGES . "book12.jpg");
define("LOGO", PATH_IMAGES . "books_logo.jpg");
define("PAGE_HOME", "index.php");
define("PAGE_PRODUCTS", "productss.php");
define("PAGE_CART", "cart.php");
define("PAGE_ORDERS", "orders.php");
define("PAGE_CONTACT_US", "contact.php");
define("PAGE_ACCOUNT", "account.php");
define("PAGE_LOGOUT", "logout.inc.php");
define("PURCHASES_PAGE", "purchases.php");
define("PAGE_LOGIN", "login.php");
define("PAGE_SIGNUP", "signup.php");
define("BUY_PAGE", "buy.php");
define("SEARCH_ORDERS_PAGE", "searchOrders.php");
define('FOLDER_CSS', 'CSS/');
define('FILE_CSS', FOLDER_CSS . 'Style.css');
define('COMMON_FUNCTIONS', PATH_FUNCTIONS . 'commonFunctions.php');
define('MAX_NAME_LENGTH', 20);
define('MAX_CITY_LENGTH', 8);
define("CUSTOMER_NAME_MAX_LENGTH", 20);
define('CUSTOMER_ADDRESS_CITY_PROVINCE_MAX_LENGTH', 25);
define("CUSTOMER_USERNAME_MAX_LENGTH", 12);
define('CUSTOMER_PASSWORD_MAX_LENGTH', 255);
define('CUSTOMER_POSTAL_CODE_MAX_LENGTH', 7);
define('PRODUCT_CODE_MAX_LENGTH', 12);
define('PRODUCT_DESCRIPTION_MAX_LENGTH', 100);
define('PRODUCT_PRICE_MAX', 10000);
define('TAX_RATE', 0.152);

define('MIN_QTY', 0);
define('MAX_QTY', 99);
define('MAX_COMMENT_LENGTH', 200);


//static products array
$products_array = array(
    array(
        "name" => "Mythos",
        "photo" => "Media/book1.jpg",
        "id" => "Book1",
        "price" => 19.99
    ),
    array(
        "name" => "The_Vegetarian",
        "photo" => "Media/book2.jpg",
        "id" => "Book2",
        "price" => 19.99
    ),
    array(
        "name" => "The_Murder_on_the_Links",
        "photo" => "Media/book3.jpg",
        "id" => "Book3",
        "price" => 19.99
    ),
    array(
        "name" => "Theory_of_Everything",
        "photo" => "Media/book4.jpg",
        "id" => "Book4",
        "price" => 19.99
    ),
    array(
        "name" => "Death_on_the_Nile",
        "photo" => "Media/book5.jpg",
        "id" => "Book5",
        "price" => 19.99
    ),
    array(
        "name" => "Murder_on_the_orient_express",
        "photo" => "Media/book6.jpg",
        "id" => "Book6",
        "price" => 19.99
    ),
    array(
        "name" => "A_holiday_for_murder",
        "photo" => "Media/book7.jpg",
        "id" => "Book7",
        "price" => 19.99
    ),
    array(
        "name" => "The_Goldfinch",
        "photo" => "Media/book8.jpg",
        "id" => "Book8",
        "price" => 19.99
    ),
    array(
        "name" => "Becoming_Michelle_Obama",
        "photo" => "Media/book9.jpg",
        "id" => "Book9",
        "price" => 19.99
    ),
    array(
        "name" => "Philosophers_Stone",
        "photo" => "Media/book10.jpg",
        "id" => "Book10",
        "price" => 19.99
    ),
    array(
        "name" => "Rich_Dad_Poor_Dad",
        "photo" => "Media/book11.jpg",
        "id" => "Book11",
        "price" => 19.99
    ),
    array(
        "name" => "Steve_Jobs",
        "photo" => "Media/book12.jpg",
        "id" => "Book12",
        "price" => 19.99
    ),
);

//function nav(){
//    echo '
//    <nav class="navigation" id="navigation">
//    <link rel="stylesheet" href="../CSS/Style.css">
//  <div class="container">
//    <img class="logo" src = " '.LOGO.'">
//    <ul class="navigation-links">
//      <li><a href = " '.PAGE_HOME.'">HOME</a></li>
//      <li>shop</li>
//      <li class="active">about</li>
//      <li>contact</li>
//      <a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
//        <i class="fa fa-bars"></i>
//      </a>
//    </ul>
//  </div>
//  <script>
//  function responsiveMenu() {
//  const x = document.getElementById("navigation");
//  if (x.className === "navigation") {
//    x.className += " responsive";
//  } else {
//    x.className = "navigation";
//  }
//}
//</script>
//</nav>
//';
//}


// function to generate navigation menu
function navigationMenu()
{
    session_start();
    echo '
        <ul class="topnav">
        <li><img class="logo" src = " ' . LOGO . '"></li>
        <li><a href = " ' . PAGE_HOME . '">HOME</a></li>';

    if (isset($_SESSION["userid"])) {
        $name = $_SESSION["firstname"] . " " . $_SESSION["lastname"];
//        echo ' <li> <a href = "'.PAGE_PRODUCTS.'">PRODUCTS</a></li>';
//        echo ' <li> <a href = " '.PAGE_CART.'">CART</a></li>';
//        echo ' <li> <a href = " '.PAGE_ORDERS.'">ORDERS</a></li>';
        echo ' <li> <a href = " ' . BUY_PAGE . '">BUY</a></li>';
        echo ' <li> <a href = " ' . SEARCH_ORDERS_PAGE . '">PURCHASES</a></li>';
        echo ' <li class="right" > <a href = "' . PAGE_CONTACT_US . '">CONTACT-US</a></li>';
        echo '  <li class="right"> <a href = "'.PAGE_LOGOUT.'">LOGOUT</a></li>';
        echo ' <li class="right"> <a href = ""> ';
        echo "Welcome!, " . $name;
        echo '</a></li>';
        echo '  <li class="right"> <a href = "'.PAGE_ACCOUNT.'">Account</a></li>';


    } else {
        echo '<li class="right" > <a href = "' . PAGE_LOGIN . '">LOGIN</a></li>';
    }
//    <li class="right" > <a href = "'.PAGE_SIGNUP.'">SIGN-UP</a></li>
//        <li class="right" > <a href = "'.PAGE_CONTACT_US.'">CONTACT-US</a></li>
    echo '</ul>';


}

//display copyright
function displayCopyright()
{
    // Copyright <your name (your student number)> 2020
    echo 'Coded with <3 by Rahul Pipaliya';
    echo "<span id='copyright'> &copy; Copyright (2012728) " . date("Y") . "</span>";

}


// to genrate footer
function pageFooter()
{
    echo '</body>
    <div class="footer">
      ';
    displayCopyright();
    echo '
        </div>
    ';
}

// to display title as the function name suggests , duh!
function displayTitle($titleName)
{

    ?>
    <div class="header">
        <h1><?php echo $titleName; ?></h1>
    </div>
    <?php
}

//again , but for subtitle xD
function displaySubtitle($titleName)
{

    ?>
    <div class="sub-title">
        <h1><?php echo $titleName; ?></h1>
    </div>
    <?php
}


//to send all the network headers
function sendHeadersForNoCache()
{
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache; charset=utf-8");
}

//page header
function pageHeader($title)
{
    sendHeadersForNoCache();
    ?><!DOCTYPE HTML>
    <meta charset="utf-8"/>
    <html>
    <head>
        <meta charset=\"UTF-8\">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo FILE_CSS; ?>">

    </head>
    <?php navigationMenu(); ?>
    <body>
    <?php
}

// to save the orders in the purchases.txt
function saveOrder(string $id, $fName, string $lName, string $city, string $cmts, float $prc, int $qty)
{
    $myfile = fopen("./Data/purchases.txt", "a") or die("Unable to open file!"); // open file as append mode

    //setting all the variables to store into file
    $product_id = $id;
    $firstName = $fName;
    $lastName = $lName;
    $cityName = $city;
    $comments = $cmts;
    $price = $prc;
    $quantity = $qty;
    $subtotal = $price * $qty;
    $taxesAmount = $subtotal * 0.15;
    $grandTotal = $subtotal + $taxesAmount;

    //genrating array and encoding it and writing it to file
    $order = json_encode(array($product_id, $firstName, $lastName, $cityName, $comments, $price, $quantity, $subtotal, $taxesAmount, $grandTotal)) . "\n";
    fwrite($myfile, $order);

    //closing file
    fclose($myfile);
}


// for commmand = color  query param
function showPrice(string $prc)
{
    $price = floatval($prc); // converting to float if it is not
    if ($price < 100.00) {
        // color = red
        echo " <tr style='color: red'>$price.'$'</tr>";
    } else if ($price <= 999.99 && $price >= 100) {
        //color light salmon
        echo '<tr style="color:lightsalmon"> $price."$" </tr>';
    } else if ($price >= 1000) {
        // color green
        echo '<tr style="color:green"> $price."$" </tr>';
    }
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/OPR/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } elseif (preg_match('/Edge/i', $u_agent)) {
        $bname = 'Edge';
        $ub = "Edge";
    } elseif (preg_match('/Trident/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}

//function to enable logging
function enableLogging()
{
//    display_errors(false);
    ini_set("log_errors", 1);
    ini_set("error_log", "./LOGS/error.txt");
}

//log error
function logError(string $description, string $errCode, string $filename, string $line)
{
    $timeOfError = date("Y/m/d H:i:s:v");
    $browser = getBrowser();
    $browserInfo = $browser['name'] . " " . $browser['version'];
    $error = strval($description . "," . $errCode . "," . $timeOfError . "," . $filename . "," . $line . "," . $browserInfo);
    error_log($error);
}

//check if all the data are valid
function isAllDataValid(bool $fname, bool $lname, bool $city, bool $quantity): bool
{
    if ($fname == true && $lname == true && $city == true && $quantity == true) {
        return true;
    }
    return false;
}


// function to trim , strip and convert it to special chars to save from injection
function removeInjection($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function isUsernameExist($userName)
{
    try {
        global $connection;
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connection->prepare("CALL get_password(:username)");
        $stmt->bindParam(':username', $userName);

        // call the stored procedure
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo 'Exception occurred: ' . $e->getMessage();
    }

}

function isProductExist($productId)
{
    try {
        global $connection;
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connection->prepare("CALL get_product_detail(:productId)");
        $stmt->bindParam(':productId', $productId);
        // call the stored procedure
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo 'Exception occurred: ' . $e->getMessage();
    }
}



?>