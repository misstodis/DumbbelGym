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
    <div class="container">
        <div class="row justify-content-center">
            <div class="list-group listgroup-flush">
                <?php displayCursus(); ?>
            </div>
        </div>
         <!-- video display  -->
        <div class="VideoCursus">
                <video controlsList="nodownload" controls="true" id="myVideo"> <sorce src="" ></video>
                <img src="./img/close.png" class="close" onclick="toggle();">
        </div>
        <!-- end videodisplay -->
    </div>
    <script src="./js/scrip.js" type="text/javascript"></script>
<?php displayHTMLFooter();?>