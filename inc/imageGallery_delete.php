<?php

require_once "funtion.php";
function getProductsGlDelete($deleteid)
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $ProductsGl = array();
        // delete product
    if(isset($_GET["deleteGLid"]))
    {
        $getProductsGlSQL = "SELECT * FROM `product_imagelibrary` WHERE `imagelibraryid` =".$_GET["deleteGLid"];
    }
    $result = $conn->query($getProductsGlSQL) or die($conn->error);
    // fetch result to associative array
    $ProductsGl = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $ProductsGl;
}
if(isset($_GET['deleteGLid']) && !empty($_GET['deleteGLid']))
{
    $conn = dbconnect();
    // given forductid to funtion getProductsGlDelete()
    $productsGl = getProductsGlDelete($_GET['deleteGLid']);
    if(isset($productsGl))
    {
        //delete image from folder
        unlink ("..". $productsGl[0]['imagelibraryname']);
    }
    // delete product information from data base
    $result = mysqli_query($conn,"DELETE FROM `product_imagelibrary` WHERE `imagelibraryid`=".$_GET['deleteGLid']);
    if (!$result) 
    {
        $error = "can't not delete product";
    }
    mysqli_close($conn);
    if (isset($error)) {
        ?>
            <div class="errors-upload-product"> 
                <h3> error: <?= $error ?> </h3>
                <a href="../admin/product_editing.php?changeid=<?= $productsGl[0]['productid'] ?>">Back to product edit</a>
            </div>
        <?php
    }
    else
    {
        ?>
            <div class="errors-upload-product"> 
                <h3> Delete compleet </h3>
                <a href="../admin/product_editing.php?changeid=<?= $productsGl[0]['productid'] ?>">Back to product edit</a>
            </div>
        <?php
    }
}

?>