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
            <h2>Welcome Mouaz</h2>
            <a class="btn btn--secondary btn--small section-header__link log-out" href=""> LOG OUT</a>
        </div>
    </div>
    <div class="account-main" >
        <div class="account-box1">
            <h3>Personalia</h3>
            <p>Name: Mouaz Mabda</p>
            <p>Address: Keizerinmarialaan 4</p>
            <p>Email: 81871@roc-teraa.nl</p>
        </div>
        <div class="account-box2">
            <h3>My Item</h3>
        </div>
        <div class="account-box3">
            <h3>Manage Login</h3>
            <label for="Reset-Login"><span>Reset Login</span> 
                <span>
                    <input id="Reset-Login" name="Reset-Login" type="checkbox">
                </span>
            </label><br>
                <p>User Name: <a href="#"> TheAntMan </a></p>
                <p>Email: <a href="#"> 81871@roc-teraa.nl </a></p>
                <p>Password: <a href="#">********* </a></p>
            <div class="form-group">
                    <label for="username" >Username:</label><br>
                    <input type="text" name="username" id="username" class="form-control">
                </div>  
                <div class="form-group">
                    <label for="email" >E-mail:</label><br>
                    <input type="text" name="email"class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" >Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
        </div>
    </div>
</div>
<?php displayHTMLFooter();?>