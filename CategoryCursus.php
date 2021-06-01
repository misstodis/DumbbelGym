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
        <div class="row align-items-start">
            <h1>chest</h1>
            <div class="col">
                <video style src="./video/intro-video.mp4" controls="true"></video>
                <p>789456123 </p>
            </div>
            <div class="col">
                <video style src="./video/intro-video.mp4" controls="true"></video>
            </div>
            <div class="col">
                <video style src="./video/intro-video.mp4" controls="true"></video>
            </div>
            <div class="col">
                <video style src="./video/intro-video.mp4" controls="true"></video>
            </div>
            <div class="col">
                <video style src="./video/intro-video.mp4" controls="true"></video>
            </div>
            <!-- <div class="col">
                <video style src="./video/intro-video.mp4" controls="true"></video>
            </div>       -->
        </div>
        <div class="row align-items-center">
            <h1>Back</h1>
            <div class="col">
            One of three columns
            </div>
            <div class="col">
            One of three columns
            </div>
            <div class="col">
            One of three columns
            </div>
        </div>
        <div class="row align-items-end">
            <h1>Shoulders&Arms </h1>
            <div class="col">
            One of three columns
            </div>
            <div class="col">
            One of three columns
            </div>
            <div class="col">
            One of three columns
            </div>
        </div>
        <div class="row align-items-end">
            <h1>Legs</h1>
            <div class="col">
            One of three columns
            </div>
            <div class="col">
            One of three columns
            </div>
            <div class="col">
            One of three columns
            </div>
        </div>
    </div>

<?php displayHTMLFooter();?>