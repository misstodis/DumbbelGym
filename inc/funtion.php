<?php
//connect to database
function dbconnect() 
{
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "dumbbellgym";

$conn = new mysqli($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

return $conn;

}

// get the categories from the data base
function getCategories()
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $categories = array();
    // define sql
    $getCategorySQL = "SELECT * FROM `categories`";
    // run sql
    $result = $conn->query($getCategorySQL) or die($conn->error);
    // fetch result to associative array teams
    $categories = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $categories;
}

// make funtion display categ
function displayCatagories()
{
    $categories = getCategories();
    foreach($categories as $category)
    {
        ?>
            <div class="CategoryName">
                <div class="CategoryText">
                    <h2><?php echo $category['catagoryname'] ?></h2>
                </div>
                <a href="CategoryCursus.php?categoryid=<?php echo $category['catagoryid'];?>"><img class="CategoryImage" src="./img/catagories/<?php echo $category['catagoryimage'] ?>"></a>
            </div>
        <?php
    }
}
//funtin to get cursus
function getCursus()
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $cursus = array();

    if (isset($_GET['categoryid'])) 
    {
        $categoryid = $_GET['categoryid'];
        // define sql
       $getCursusSQL = "SELECT * FROM `cursus` LEFT JOIN `categories` ON `cursus`.`catagoryid` = `categories`.`catagoryid` WHERE `cursus`.`catagoryid` = $categoryid" ;
       // run sql
        $result = $conn->query($getCursusSQL) or die($conn->error);
        // fetch result to associative array teams
        $cursus = $result->fetch_all(MYSQLI_ASSOC);
        //close connection for safety
        $conn -> close();
        // return regions array
        return $cursus;
    }
    else
    {
        echo "</h1> There is nothing </h1>";
    }
}
//make funtion display cursus
function displayCursus()
{
    $cursus = getCursus();
    ?>
        <div class ="cursusinfo-head">
            <h1> <?php echo $cursus[0]['catagoryname']?>  </h1>
            <a href="#" onclick="toggle(); playVideo('./video/intro-video.mp4');"><i class="bi bi-youtube"> Intro Video</i></a>
        </div>
            <?php
                foreach($cursus as $cursu)
                {
                    ?>
                    <div class="card border-0 mb-3 shadow">
                        <div class="card-body border-bottom">
                            <h5 class="card-title mb-0"><?php echo $cursu['cursusname']?></h5>
                        </div>
                        <div class="list-group">
                                <!-- give cursusid from getCursus() to funtion getCursusInfo and put in variable -->
                                <?php $cursusinfos = getCursusInfo($cursu['cursusid']);
                                    // make a loop to print out the infomation
                                    // call variable as other name to loop
                                    foreach($cursusinfos as $cursusinfo)
                                    {
                                        ?>
                                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="#" onclick="toggle(); playVideo('./video/<?php echo $cursusinfo['cursusinfovideo'] ?>');" >
                                                <div class="cursus-info">
                                                    <small class ="text-muted mb-0"><?php echo $cursusinfo['cursusinfoname'] ?></small><br>
                                                    <img class="mb-0"src="./video/<?php echo $cursusinfo['cursusinfoimage'] ?>">
                                                </div>
                                                <div>
                                                    <h6> <?php echo $cursusinfo['cursusinforeps']; ?> </h6>
                                                </div>
                                            </a>                                        
                                        <?php
                                    }
                                ?>
                        </div>
                    </div>
                    <?php                 
                }
            ?>

    <?php
}
// make funtion this get cursusinfo from database
function getCursusInfo($cursusid)
{
        // get connect to database
        $conn = dbconnect();
        // define a empty array
        $cursusInfo = array();
        // define sql
        $getCursusInfoSQL = "SELECT * FROM `cursus_info` JOIN cursus ON cursus_info.cursusid = cursus.cursusid WHERE cursus.cursusid = $cursusid";
        // run sql
        $result = $conn->query($getCursusInfoSQL) or die($conn->error);
        // fetch result to associative array teams
        $cursusInfo = $result->fetch_all(MYSQLI_ASSOC);
        //close connection for safety
        $conn -> close();
        // return regions array
        return $cursusInfo;
}


//make funtion display html head
function displayHTMLhead()
{
    ?>
        <!DOCTYPE html>
        <html lang="en" dir="ltr">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dumbel Gym</title>
            <link rel="stylesheet" href="css/style.css">
            <!-- connect to bootrap cs -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
            <meta charset="utf-8">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
            <!-- End connect to bootrap cs -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        </head>

        <body>
            <header class="header-contain" >
                <div class="header-container" id="navbar" >
                    <div class="d-flex align-items-center">
                        <div class="logo-contain">
                            <a href="index.php"><img src="./img/logo.png"></a>
                        </div>
                        <div class="login-contain">
                            <a href="login.php" class="btn-login"><i class="bi bi-person-circle"></i></a>
                        </div>

                        <div class="shoping-contain">
                            <a href="#" id="shoping-car"><i class="bi bi-cart"></i></a>
                        </div>
                    </div>
                </div>
            </header>
    <?php
}

//make funtion display html footer
function displayHTMLFooter()
{
    ?>
            <footer>
                <div class="footer-contain">
                    <!-- Section: Social media -->
                    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                        <!-- Left -->
                        <div class="me-5 d-none d-lg-block">
                            <span>Get connected with us on social networks:</span>
                        </div>
                        <!-- Left -->

                        <!-- Right -->
                        <div>
                            <a href="" style="text-decoration: none;" class="me-4 text-reset">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="" style="text-decoration: none;" class="me-4 text-reset">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="" class="me-4 text-reset">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                        <!-- Right -->
                    </section>
                    <!-- Section: Social media -->

                    <!-- Section: Links  -->
                    <section class="">
                        <div class="container text-center text-md-start mt-5">
                            <!-- Grid row -->
                            <div class="row mt-3">
                                <!-- Grid column -->
                                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                    <!-- Content -->
                                    <h6 class="text-uppercase fw-bold mb-4 logo-contain">
                                        <img src="./img/logo.png">DUMBBEL GYM
                                    </h6>
                                    <p> True pros never stop learning.
                                        The Dumbbel Gym brings you hacks straight from our experts and takes you inside
                                        the hottest issues in health and fitness.
                                    </p>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                    <!-- Links -->
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        <a style="text-decoration: none; color: black" href="">About</a>
                                    </h6>
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                    <!-- Links -->
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        Contact
                                    </h6>
                                    <p><i class="bi bi-house"></i> Roc Ter AA, 5702 BR, NL</p>
                                    <p><i class="bi bi-envelope"></i><a href="mailto: Dumbbelgym@hotmail.com">Dumbbelgym@hotmail.com</a></p>
                                    <p><i class="bi bi-telephone"></i> + 31 234 567 88</p>
                                    <p><i class="bi bi-telephone"></i> + 31 234 567 89</p>
                                </div>
                                <!-- Grid column -->
                            </div>
                            <!-- Grid row -->
                        </div>
                    </section>
                    <!-- Section: Links  -->

                    <!-- Copyright -->
                    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                        © 2021 Dumbbel Gym
                    </div>
                    <!-- Copyright -->
                </div>
            </footer>
        </body>
        </html>
    <?php
}

/*--------------------Sign Up Page Functions---------------*/

function emptyInputSignup($username, $fname, $lname, $email, $pwd, $confirmpassword, $place, $postcode, $adress) {
    $result;
    if(empty($username) || empty($fname) || empty($lname) || empty($email) || empty($pwd) || empty($confirmpassword) || empty($place) || empty($postcode) || empty($adress))
    {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidUid($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function pwdMatch($pwd, $confirmpassword) {
    $result;
    if($pwd !== $confirmpassword)
    {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function uidExist($conn, $username, $email) {
    $sql = "SELECT * FROM `users` WHERE `useruid` = ? OR `useremail` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $fname, $lname, $email, $pwd, $place, $postcode, $adress) {
    $sql = "INSERT INTO `users` (`useruid`, `firstname`, `lastname`, `useremail`, `password`, `userplaats`, `userpostcode`, `useradress`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("Location: ../signup.php?error=stmtfailed1");
        exit();
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $fname, $lname, $email, $hashedpwd, $place, $postcode, $adress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../signup.php?error=none");
    exit();
}
?>

