<?php
/*
#Revision history:
#
// 26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
// 22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
// 21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
// 20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/



// this page will be used for destroying all the session objects and removing the session variables
session_start();
session_unset();
session_destroy();

//redirect the user to login page after logout and exit the script
header("location: login.php");
exit();
