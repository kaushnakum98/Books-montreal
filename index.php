<?Php
/*
#Revision history:
#
24 Rahul on 12/8/2020 at 12:06 PM Rahul Pipaliya(2012728) 2020-12-08 added exception handing
23 Rahul on 12/8/2020 at 9:15 AM Rahul Pipaliya(2012728) 2020-12-08 added link to download cheat sheet
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page
*/
//include common functions ,header , display title & subtitles
include 'Functions/commonFunctions.php';
pageHeader('Home Page');
displayTitle('Welcome to the booksMTL!');
enableLogging();
echo "<h3>Looking for your next great read? Get personalized recommendations from our book experts.  booksMTL is the biggest online book store of the Montréal , we have also launched another products as well</h3>";
displaySubtitle('Trending Books Right Now!');

?>
<!--link to download cheat sheet-->
<h1><a download href="Data/CHEAT_SHEET_2012728_RAHUL_PHP.txt">
        Download My Cheat Sheet
    </a></h1>


<!-- Slideshow container -->
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
        <div class="numbertext">1 / 4</div>
        <a href="https://www.newegg.ca/" target=_>
            <img id = "showcase" alt="404" src=<?php echo PICTURE_BOOK1; ?> style="width:120% ;border: 5px solid #8B0000;"> </a>
        <h5>Greek Mythology</h5>
        <h5>$39.98</h5>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 4</div>
        <a href="https://www.newegg.ca/" target=_>
            <img id = "showcase" alt="404" src=<?php echo PICTURE_BOOK2; ?> style="width:70">
            <h5>The Vegeterian</h5>
            <h5>$19.99</h5>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 4</div>
        <a href="https://www.newegg.ca/" target=_>
            <img id = "showcase" alt="404" src=<?php echo PICTURE_BOOK3; ?> style="width:70%">
            <h5>The Murders on the Links</h5>
            <h5>$19.99</h5>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">4 / 4</div>
        <a href="https://www.newegg.ca/" target=_>
            <img id = "showcase" alt="404" src=<?php echo PICTURE_BOOK4; ?> style="width:70%">
            <h5>Theory Of Everything</h5>
            <h5>$19.99</h5>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>
</div>
<!--use js functions-->
<script type="text/javascript" src="Js/jsFunctions.js"></script>



<!--display page footer-->
<?php
pageFooter();
?>
