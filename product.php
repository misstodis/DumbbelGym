<?php
$funtionsFile = "inc/funtion.php";
// if the funtion not exist
if(!file_exists($funtionsFile))
{
    die("missing funtions file !!!") ;
}

// include the funtions file 
require($funtionsFile);

// display head html
displayHTMLhead();
?>
<?php 
if(!isset($_GET['productid']))
{
    displayProductList();
}
else
{
    displayProductDetail($_GET['productid']);
}


?>

<?php displayHTMLFooter();?>