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
<div class="account-contain">
    <div id="" class="row justify-content-center align-items-center ">
        <div class="col-md-2 acount-test">
            <h2>Welcome <?php echo $_SESSION['user']['firstname']; ?></h2>
            <a class="btn btn--secondary btn--small section-header__link log-out" href="inc/logout.inc.php" onclick="return confirm('Are you sure you want to log out')">LOG OUT</a>
        </div>
    </div>
<?php
profilePage();
?>
        <div class="account-box2">
            <h3>My Items</h3>
        </div>
        
</div>
<?php displayHTMLFooter();?>