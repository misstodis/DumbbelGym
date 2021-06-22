<?php
$funtionsFile = "../inc/funtion.php";
// if the funtion not exist
if(!file_exists($funtionsFile))
{
    die("missing funtions file !!!") ;
}

// include the funtions file 
require($funtionsFile);

// display head html

//check if inlog as a admin account 
if(isAdminlogin() == true)
{
    displayAdminHTMLhead();
    ?>
        <div class="admin-add-product">
            <a href="product_editing.php" style="color:white;">
                <button type="button" class="btn btn-info">
                    add product
                </button>
            </a>
        </div>
        <div class="clearfix"></div>
        <table class="admin-table-upload table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">image</th>
                <th scope="col">product name</th>
                <th scope="col">product price</th>
                <th scope="col">product descripton</th>
                <th scope="col">change</th>
                <th scope="col">delete</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $products = getProducts();
                    foreach($products as $product)
                    {
                        ?>
                        <tr>
                            <th class="admin-table-pdimage" scope="row"><img src="..<?php echo  $product['productimg']?>"></th>
                            <td ><?php echo $product['productname'] ?></td>
                            <td >€ <?php echo $product['productprice'] ?></td>
                            <td><?php echo $product['productdesc'] ?></td>
                            <td><a href="product_editing.php?changeid=<?php echo $product['productid'] ?>"><button type="button" class="btn btn-info">change</button></a></td>
                            <td><a href="../inc/product_delete.php?deleteid=<?php echo $product['productid'] ?>"><button type="button" class="btn btn-info">Delete</button></a></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    <?php
    displayAdminHTMLFooter();
}
// if not login wit admin account
else
{
    displayAdminHTMLhead();    
    ?> 
        <div  class="ask-adimlogin">
            <a href="../login.php">
                <h2>Login As Admin first</h2>
            </a>
        </div>
    <?php
    displayAdminHTMLFooter();
}
?>