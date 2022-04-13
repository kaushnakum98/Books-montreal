<?Php
/*
#Revision history:
#
#DEVELOPER                         DATE                                COMMENTS
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page
*/
//include common functions ,header , display title & subtitles
include 'Functions/commonFunctions.php';
require_once('products.php');
require_once('product.php');
require_once('purchase.php');
pageHeader('Buy Page');
displayTitle('Buy Our Product!');
enableLogging(); // enable logging.


//variable to store and display errors
$productErr = $qtyErr = $commentsErr = "";
//variables to store the values..
$product = $qty = $comments = "";

function validateProduct($product)
{
    var_dump($product);
    if (empty($product)) {
        return "EmptyProd";
    }
    return true;
}

function validateQuantity($quantity)
{
    var_dump($quantity);
    if ($quantity == 0) {
        return "EmptyQty";
    }
    if ($quantity > MAX_QTY) {
        return "MaxQty";
    }
    return true;
}

if (isset($_POST['buy'])) {
    //validating the product and saving it into variable
    if (mb_strlen($_POST["product"]) == 0) {
        $productErr = "Product is required";
    } else {
        $product = $_POST["product"];
    }

    //validating the optional comments and saving it into variable
    if (mb_strlen($_POST["comments"]) > MAX_COMMENT_LENGTH) {
        $commentsErr = "max length of comment is " . MAX_COMMENT_LENGTH;
    } else {
        $comments = $_POST["comments"];
    }

    //validating the quanitity and saving it into variable
    if (intval($_POST["quantity"]) <= MIN_QTY) {
        $qtyErr = "Quantity is required";
    } else if (intval($_POST["quantity"]) > MAX_QTY) {
        $qtyErr = "Max Quantity is " . MAX_QTY;
    } else {
        $qty = intval($_POST["quantity"]);
    }

    // if errors are not present , then save it into object and make a stored procedure call to add into database..
    if (mb_strlen($product) !== 0 && mb_strlen($comments) <= MAX_COMMENT_LENGTH && $qty >= MIN_QTY && $qty <= MAX_QTY) {
        $order = new purchase($product, $qty, $comments);
//        var_dump($product,$qty,$comments);
        $order->save();
    }


}


?>

<!--code for buy form-->
<div class="center">
    <form class="signup" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
        <h1>Buy</h1>
        <div class="signup__field">
            <p><span class="error">* = required field</span></p>
            <select name="product">
                <option value=""><label class="signup__label" for="comments">Select A Product *</label></option>
                <?php
                $products = new products();
                foreach ($products->items as $product) {
                    echo "<option value=" . $product->getProductId() . ">" . $product->getProductCode() . "-" . $product->getDescription() . "</option>";
                }
                ?>
            </select>
            <span class="error"><?php echo $productErr; ?></span>
        </div>

        <div class="signup__field">
            <input class="signup__input" type="text" name="comments" id="comments" maxlength="200"/>
            <label class="signup__label" for="comments">Comments</label>
            <span class="error"><?php echo $commentsErr; ?></span>
        </div>

        <div class="signup__field">
            <input class="signup__input" type="quantity" value=0 name="quantity" id="quantity" maxlength="2"/>
            <label class="signup__label" for="quantity">Quantity *</label>
            <span class="error"><?php echo $qtyErr; ?></span>
        </div>

        <button name="buy">Buy</button>
    </form>
</div>

<!--display page footer-->
<?php
pageFooter();
?>
