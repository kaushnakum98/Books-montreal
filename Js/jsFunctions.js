/*
#Revision history:
#
26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
14 Rahul on 10/30/2020 at 5:59 PM Rahul Pipaliya(2012728) 2020-10-30 added error logging..
11 Rahul on 10/30/2020 at 12:43 AM Rahul Pipaliya(2012728) 30-10-2020 added function to check validations..
10 Rahul on 10/29/2020 at 2:35 AM Rahul Pipaliya(2012728) 29-10-2020 removed extra code and added comments..
6 Rahul on 10/27/2020 at 11:15 PM Rahul Pipaliya(2012728) 27-10-2020 added functionality to save the orders into purchases.txt
3 Rahul on 10/20/2020 at 3:45 PM Rahul Pipaliya  (2012728) 2020-10-20  removed products code
2 Rahul on 10/4/2020 at 3:18 PM import init
*/

//static products array
const productsArray = [
    {
        "name": "Mythos",
        "photo": "Media/book1.jpg",
        "id": "Book1",
        "price": 19.99
    },
    {
        "name": "The_Vegetarian",
        "photo": "Media/book2.jpg",
        "id": "Book2",
        "price": 19.99
    },
    {
        "name": "The_Murder_on_the_Links",
        "photo": "Media/book3.jpg",
        "id": "Book3",
        "price": 19.99
    },
    {
        "name": "Theory_of_Everything",
        "photo": "Media/book4.jpg",
        "id": "Book4",
        "price": 19.99
    },
    {
        "name": "Death_on_the_Nile",
        "photo": "Media/book5.jpg",
        "id": "Book5",
        "price": 19.99
    },
    {
        "name": "Murder_on_the_orient_express",
        "photo": "Media/book6.jpg",
        "id": "Book6",
        "price": 19.99
    },
    {
        "name": "A_holiday_for_murder",
        "photo": "Media/book7.jpg",
        "id": "Book7",
        "price": 19.99
    },
    {
        "name": "The_Goldfinch",
        "photo": "Media/book8.jpg",
        "id": "Book8",
        "price": 19.99
    },
    {
        "name": "Becoming_Michelle_Obama",
        "photo": "Media/book9.jpg",
        "id": "Book9",
        "price": 19.99
    },
    {
        "name": "Philosophers_Stone",
        "photo": "Media/book10.jpg",
        "id": "Book10",
        "price": 19.99
    },
    {
        "name": "Rich_Dad_Poor_Dad",
        "photo": "Media/book11.jpg",
        "id": "Book11",
        "price": 19.99
    },
    {
        "name": "Steve_Jobs",
        "photo": "Media/book12.jpg",
        "id": "Book12",
        "price": 19.99
    }
];


var slideIndex = 1; // set index to first photo
showSlides(slideIndex); // show first photo

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

//function to show slides
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}


//in cart.php to show products information according to user selection dynamically
function getCurrentId() {
    const selected = document.getElementById("books").value; // get selected id of the product
    //iterate over array to check whether selected id is in array , if it is then set its values and photos
    productsArray.forEach(item => {
        if (item.id === selected) {
            document.getElementById("bkid").innerHTML = item.id;
            document.getElementById("image").src = item.photo;
            document.getElementById("name").innerHTML = item.name;
            document.getElementById("price").value = item.price;
            document.getElementById("stkStatus").innerHTML = "In Stock!"
        }
    })
}
