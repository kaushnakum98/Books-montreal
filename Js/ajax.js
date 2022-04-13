
/*
#Revision history:
#
// 26 Rahul on 12/13/2020 at 3:50 PM Rahul Pipaliya(2012728) 2020-12-13 updated cheat sheet/removed extra code
// 22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
// 21 Rahul on 12/7/2020 at 3:29 AM Rahul Pipaliya(2012728) 2020-12-07 added search orders functionality , update account functionalities
// 20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/
// showing the error to the user
function handleError(error) {
    alert('something went wrong : ' + error)
}

//this function will use ajax render the data into the page without reloading it
function searchPurchase() {
    try {
        // An XMLHttpRequest object is created by JavaScript
        const xhr = getXmlHttpRequest();

        //this function will be invoked as the state of our XMLHttpRequest object changes
        // 0	UNSENT	                Client has been created. open() not called yet.
        // 1	OPENED	                open() has been called.
        // 2	HEADERS_RECEIVED	    send() has been called, and headers and status are available.
        // 3	LOADING	Downloading;    responseText holds partial data.
        // 4	DONE	                The operation is complete.
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                //if the request has been successful means status is 200 then change the update the page using innerHTML.
                //response of the request will be in responseText
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        }

        // To send a request to a server, we use the open(method, url, async) we have used POST method and sent the request to the searchPurchases page
        xhr.open('POST', 'searchPurchases.php');

        //we have set the value of header Content-Type to application/x-www-form-urlencoded(which means no binary object or BLOB) using setRequestHeader
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        //getting the value of the search date using getElementById method
        const searchDate = document.getElementById("searchDateQuery").value;

        //sending the request with data in url as the date.
        xhr.send("searchDate=" + searchDate);
    } catch (error) {
        handleError(error);
    }
}

//this function will generate XMLHttpRequest object that will work on  users browser that supports the ajax
function getXmlHttpRequest() {
    try {
        let xhr = null;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest(); //supports most of the browsers
        } else {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (error) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                //show this message to the user if their browser does not support AJAX
                alert("Your browser does not support AJAX!, please use Mozilla firefox or chrome.")
                return null;
            }
        }
        //return the object on successful creation
        return xhr;
    } catch (error) {
        //show error
        handleError(error);
    }
}

function deletePurchase() {
    try {
        // An XMLHttpRequest object is created by JavaScript
        const xhr = getXmlHttpRequest();

        //this function will be invoked as the state of our XMLHttpRequest object changes
        // 0	UNSENT	                Client has been created. open() not called yet.
        // 1	OPENED	                open() has been called.
        // 2	HEADERS_RECEIVED	    send() has been called, and headers and status are available.
        // 3	LOADING	Downloading;    responseText holds partial data.
        // 4	DONE	                The operation is complete.
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                //if the request has been successful means status is 200 then change the update the page using innerHTML.
                //response of the request will be in responseText
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        }

        // To send a request to a server, we use the open(method, url, async) we have used POST method and sent the request to the searchPurchases page
        xhr.open('POST', 'deletePurchases.php');


        //we have set the value of header Content-Type to application/x-www-form-urlencoded(which means no binary object or BLOB) using setRequestHeader
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        //getting the value of the purchase id using event
        const selectedPurchaseId = event.srcElement.id;

        //sending the request with data in url as the date.
        xhr.send("purchaseId=" + selectedPurchaseId);
    } catch (error) {
        handleError(error);
    }
}



