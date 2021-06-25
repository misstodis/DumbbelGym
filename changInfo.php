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

updateUserInfo();
?>

<div class="login-card">
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="singup-box" class="col-md-12">
                        <form id="login-form" action="" method="post">
                            <h3 class="text-center">Update Your info</h3>
                            <div class="form-group">
                                <label for="username" >User Name:</label><br>
                                <input type="text" name="username"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="firstname" >First Name:</label><br>
                                <input type="text" name="firstname"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lastname" >Last Name:</label><br>
                                <input type="text" name="lastname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" >E-mail:</label><br>
                                <input type="text" name="email"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="place" >Place:</label><br>
                                <input type="text" name="place"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="postcode" >PostCode:</label><br>
                                <input type="text" name="postcode" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="adress" >Adres:</label><br>
                                <input type="text" name="adress" class="form-control">
                            </div>
                            <div class="form-group signup-btn">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Update Info">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="login.php">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php displayHTMLFooter();?>