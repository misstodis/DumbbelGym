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
    <div class="intro-contain ">
        <div class="intro-video">
            <video style="width:100%;" src="./video/background.mp4" autoplay="true" loop="true" prelead="auto">
        </div>
        <div class="intro-text">
            <h1>DUMBBEL GYM</h1>
            <img class="img-fluid" src="./img/logo.png">
            <h2>Join with us!</h2>
        </div>
        <div class="video-overlay"></div>
    </div>
    
    <div class="motivate-contain">
        <h3>"Look good and feel confident.<br> Join us in our fitness website<br> to get the best bodyshape in your
            life".
        </h3>
        <div class="CheckProduct"><a href="product.php">CHECK OUT OUR PRODUCT!!</a></div>
    </div>
    <div class="category-contain">
        <div class="CategoryInfo">
            <?php displayCatagories();?>
        </div>
    </div>
<?php displayHTMLFooter();?>