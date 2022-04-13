<?Php
/*
#Revision history:
#
#DEVELOPER                         DATE                                COMMENTS
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page
*/
//include common functions ,header , display title & subtitles
include 'Functions/commonFunctions.php';
//redirectToLoginPageifNotLoggedin();
pageHeader('Account');
displayTitle('Your Account!');
require_once ('customer.php');
enableLogging();

//send the user to edit the account , with setting updatemode to true .
$url = "location: signup.php";
$_SESSION['updateMode'] = true;
header($url);
exit(); // exit the script
?>
<!--display page footer-->
<?php
pageFooter();
?>
