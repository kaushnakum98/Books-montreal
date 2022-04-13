<?php
/*
#Revision history:
#
26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities

*/




//importing the required files..
require_once("purchase.php");
require_once('database-connection.php');
require_once('collection.php');

//setting the page headers and titles , enabling logging
pageHeader('Purchases');
displayTitle('Search Purchases by Date');
enableLogging();
?>

<!--html code for search purchases will use searchPurchase of ajax.js -->
<script language="JavaScript" type="text/javascript" src="Js/ajax.js"></script>
<div class="center">
    <div class="signup__field">
        <input class="signup__input" type="date" id="searchDateQuery"/>
        <button onclick="searchPurchase();">Search</button>
        </button>
    </div>
</div>

<!--field for the searchResults if there is any it will be filled with the table of purchases here later-->
<div id="searchResults"><h1>Results Are Currently Empty</h1></div>

<!--showing the page footer-->
<?php
pageFooter();
?>



