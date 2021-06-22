<?php
require_once "funtion.php";
function getProductsDelete($deleteid)
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $Products = array();
        // delete product
    if(isset($_GET["deleteid"]))
    {
        $getProductsSQL = "SELECT * FROM products JOIN product_imagelibrary ON products.productid = product_imagelibrary.productid WHERE products.productid =".$_GET["deleteid"];
    }
    $result = $conn->query($getProductsSQL) or die($conn->error);
    // fetch result to associative array
    $Products = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $Products;
}
if(isset($_GET['deleteid']) && !empty($_GET['deleteid']))
{
    $conn = dbconnect();
    // given forductid to funtion getProductsDelete()
    $products = getProductsDelete($_GET['deleteid']);
    if(isset($products))
    {
        // foreach to delete library image from folder
        foreach($products as $product)
        {
            unlink("..". $product['imagelibraryname']);
        }
        //delete image from folder
        unlink ("..". $products[0]['productimg']);
        unlink ("..". $products[0]['productimg2']);
    }
    // delete product information from data base
    $result = mysqli_query($conn,"DELETE FROM `product_imagelibrary` WHERE `productid`=".$_GET['deleteid']);
    $result = mysqli_query($conn,"DELETE FROM `products` WHERE `productid`=".$_GET['deleteid']);
    if (!$result) 
    {
        $error = "can't not delete product";
    }
    mysqli_close($conn);
    if (isset($error)) {
        ?>
            <div class="errors-upload-product"> 
                <h3> error: <?= $error ?> </h3>
                <a href="../admin/index.php">Back to product list</a>
            </div>
        <?php
    }
    else
    {
        ?>
            <div class="errors-upload-product"> 
                <h3> Delete compleet </h3>
                <a href="../admin/index.php">Back to product list</a>
            </div>
        <?php
    }
}

?>