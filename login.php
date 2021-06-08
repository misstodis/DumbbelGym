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

<div class="login-card">
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" action="" method="post">
                            <h3 class="text-center">Login</h3>
                            <div class="form-group">
                                <label for="username" >Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" >Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me"><span>Remember me</span> 
                                    <span>
                                        <input id="remember-me" name="remember-me" type="checkbox">
                                    </span>
                                </label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="signup.php">Register here</a>
                            </div>
                            <div id="forgot-link">
                                <a href="#">forgot password ?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php displayHTMLFooter();?>