<?php
session_start();
// make funtion connecting to the database
function dbconnect()
{
    $severname="localhost";
    $username="root";
    $password ="";
    $dbname = "dumbbellgym";
    // Create connection
    $conn = mysqli_connect($severname, $username, $password, $dbname);
    //check the connect to databse
    if (!$conn) 
    {
        die("Can't connect :" . mysqli_connect_error());
        exit();
    }
    //return databse object
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
// make funtion get product catagory
function getProductCategories()
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $ProductCategories = array();
    // define sql
    $getProductCategoriesSQL = "SELECT * FROM `product_catagory`";
    // run sql
    $result = $conn->query($getProductCategoriesSQL) or die($conn->error);
    // fetch result to associative array teams
    $ProductCategories = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $ProductCategories;
}
//make funtion get product
function getProducts()
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $Products = array();
    if(!isset($_GET["productcatagoryid"]))
    {
        $getProductsSQL = "SELECT * FROM `products`";
    }
    if(isset($_GET["productcatagoryid"]))
    {
        $getProductsSQL = "SELECT * FROM `products` WHERE productcatagoryid =".$_GET["productcatagoryid"];
    }
    $result = $conn->query($getProductsSQL) or die($conn->error);
    // fetch result to associative array teams
    $Products = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $Products;
}

function displayProductCategories()
{
    $ProductCategories = getProductCategories();
    ?>
        <div class="product-contain">
            <div class="product-nav">
                <h1>SHOP</h1>
                <div class="row align-items-start product-category ">
                    <?php
                        foreach($ProductCategories as $ProductCategory)
                        {
                            ?>  
                                <div class="col"><a href="productList.php?productcatagoryid=<?php echo $ProductCategory['productcatagoryid']; ?>"><?php echo $ProductCategory['p_catagoryname']; ?></a></div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="container product-info">
                <div class="row">
                    <?php $poducts = getProducts();
                        foreach($poducts as $poduct)
                        {
                         ?>
                            <div class="col-md-3 col-sm-6" style="margin-top: 1.5em;">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="productdetail.html" class="image">
                                            <img class="pic-1" src="./img/<?php echo $poduct["productimg"] ?>">
                                            <img class="pic-2" src="./img/<?php echo $poduct["productimg2"] ?>">
                                        </a>
                                        <!-- if there is clothes then show the size-->
                                        <?php                     
                                            if(!isset($_GET["productcatagoryid"]))
                                            {
                                                ?>
                                                <div class="product-size">
                                                    <ul class="size">
                                                    <li></li>
                                                    </ul>
                                                </div>                                        
                                                <?php
                                            }
                                            elseif($_GET["productcatagoryid"] == 1)
                                            {
                                                ?>
                                                    <div class="product-size">
                                                        <ul class="size">
                                                            <li>XS</li>
                                                            <li>S</li>
                                                            <li>M</li>
                                                            <li>L</li>
                                                            <li>XL</li>
                                                        </ul>
                                                    </div>                                        
                                                <?php                                    
                                            }           
                                        ?>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="product-title"><a href="productdetail.html"><?php echo $poduct["productname"] ?></a></h3>
                                        <div class="product-price"><?php echo $poduct["productprice"] ?></div>
                                    </div>
                                </div>
                            </div>
                         <?php   
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php
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
            <link rel="stylesheet" href="css/styles.css">
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

function uploadFiles($uploadedFiles)
{
    $files = array();
    $errors = array();

    foreach($uploadedFiles as $key => $values)
    {
        foreach($values as $index => $value)
        {
            $files[$index][$key] = $value;
        }
    }
    // maken nieuw folder met naam "uploadfile" + datum
    $uploadPath = "./uploads/". date('d-m-Y',time());
    if(!is_dir($uploadPath))
    {
        mkdir($uploadPath,0777,true);
    }
    foreach( $files as $file)
    {
        $file = validateUploadFile($file, $uploadPath);
        if($file != false)
        {
            move_uploaded_file($file["tmp_name"], $uploadPath . "/" . $file["name"]);
        }
        else
        {
            $errors[] = "the file". basename($file["name"]). "isn't valid.";
        }
    }
    return $errors;
}

function validateUploadFile($file, $uploadPath)
{
    // controleren of er de file is groter dan geaccepterende file Capaciteit
    if ($file['size'] > 2 * 1024 * 1024) // max upload is 2Mb = 2 * 1024kb * 1024 bite
    {
        return false;
    }
    // checken of er file is toestand
    $validType = array("jpg","jpeg","png","bmp","mp4");
    $fileType = substr($file['name'], strrpos($file['name'],".") + 1);
    if(!in_array($fileType, $validType))
    {
        return false;
    }
    //check als er al een file met zelfde naam bestaat ? als er een bestaat dan veranderen de naam
    $num = 1;
    $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
        $fileName = $fileName . "(" . $num . ")";
        $num++;
    }
    $file['name'] = $fileName . '.' . $fileType;
    return $file;
}



/*--------------------Sign Up Page Functions---------------*/

function emptyInputSignup($username, $fname, $lname, $email, $pwd, $confirmpassword, $place, $postcode, $adress) 
{
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

function invalidUid($username) 
{
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

function invalidEmail($email) 
{
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

function pwdMatch($pwd, $confirmpassword) 
{
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

function uidExist($conn, $username, $email) 
{
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

    if ($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $fname, $lname, $email, $pwd, $place, $postcode, $adress) 
{
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

function SignupErrorCheck()
{
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "emptyInputSignup")
        {
            echo "<p>Fill in all the fields</p>";
        }

        else if ($_GET["error"] == "invaliduid")
        {
            echo "<p>The username is not valid</p>";
        }

        else if ($_GET["error"] == "invalidEmail")
        {
            echo "<p>The email is not valid</p>";
        }

        else if ($_GET["error"] == "passwordDontmatch")
        {
            echo "<p>The passwords don't match</p>";
        }

        else if ($_GET["error"] == "usernametaken")
        {
            echo "<p>This username is already taken</p>";
        }

        else if ($_GET["error"] == "stmtfailed")
        {
            echo "<p>Something went wrong!!, try again</p>";
        }

        else if ($_GET["error"] == "usernametaken")
        {
            echo "<p>This username is already taken</p>";
        }

        else if ($_GET["error"] == "none")
        {
            echo "<p>You have signed up!</p>";
        }
    }
}

/*--------------------Login Page Functions---------------*/

function emptyInputLogin($username, $pwd) 
{
    $result;
    if(empty($username) || empty($pwd))
    {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExist = uidExist($conn, $username, $username);

    if ($uidExist == false)
    {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExist['password'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false)
    {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }

    else if ($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $uidExist[`userid`];
        $_SESSION["username"] = $uidExist[`useruid`];
        $_SESSION["isUserLoggedIn"] = true;
        header("location: ../index.php");
        exit();
    }
}

function LoginErrorCheck()
{
    if(isset($_GET["error"]))
    {
        if ($_GET["error"] == "emptyInput")
        {
            echo "<p>Fill in all the fields</p>";
        }

        else if ($_GET["error"] == "wronglogin")
        {
            echo "<p>The password or the username are incorrect! Please try again</p>";
        }
    }
}

/*function isLoggedIn()
{
    if($_SESSION["isUserLoggedIn"] == true)
    {
        return true;
    }
    return false;
}*/

/*function myDump($varTodump, $exit = false)
{
    echo "<pre>";
    var_dump($varTodump);
    echo "</pre>";
    if($exit) die("done");
}*/

?>

