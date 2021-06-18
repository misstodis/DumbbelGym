<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
    require_once "funtion.php";
    $conn = dbconnect();
    $result = mysqli_query($conn,"DELETE FROM `products` WHERE `productid`=".$_GET['id']);
    if (!$result) 
    {
        $error = "can't not delete product";
    }
    mysqli_close($conn);
    if (isset($error)) {
        ?>
            <div class="errors-upload-product"> 
                <h3> error: <?= $error ?> </h3>
                <a href="../uploadproduct.php">Back to product list</a>
            </div>
        <?php
    }
    else
    {
        ?>
            <div class="errors-upload-product"> 
                <h3> Delete compleet </h3>
                <a href="../uploadproduct.php">Back to product list</a>
            </div>
        <?php
    }
}

?>