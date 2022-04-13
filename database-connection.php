<?php
/*
#Revision history:

26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page and dbpage

*/



$servername = "localhost";
$username = "";
$password = "";
$db = "";


try {


    $connection = new PDO("mysql:host=$servername;dbname=$db", $username, $password);


    //which tells PDO to disable emulated prepared statements and use real prepared statements.
    // This makes sure the statement and the values aren't parsed by PHP before sending it to the MySQL server
    // (giving a possible attacker no chance to inject malicious SQL).
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();

}

