<?php
function init() 
{
    // start or resum session
    session_start();
    // check shopping cart
    if(!isset($_SESSION['shoppingCart']))
    {
        // create empty cart
        $_SESSION['shoppingCart'] = array();
    }
    if(!isset($_SESSION['user']))
    {
        // create empty user array
        $_SESSION['user'] = array();
    }

    if(!isset($_SESSION['user']["isUserLoggedIn"]))
    {
        $_SESSION['user']["isUserLoggedIn"] = false;
    }
}

init();
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
    // fetch result to associative array
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
        // fetch result to associative array 
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
        // fetch result to associative array 
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
    // fetch result to associative array
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
    // delete product
    if(isset($_GET["deleteid"]))
    {
        $getProductsSQL = "SELECT * FROM product_catagory JOIN products ON products.productcatagoryid = product_catagory.productcatagoryid WHERE product_catagory.productcatagoryid =".$_GET["deleteid"];
    }
    if(!isset($_GET["productcatagoryid"]))
    {
        $getProductsSQL = "SELECT * FROM `products`";
    }
    elseif(isset($_GET["productcatagoryid"]))
    {
        $getProductsSQL = "SELECT * FROM product_catagory JOIN products ON products.productcatagoryid = product_catagory.productcatagoryid WHERE product_catagory.productcatagoryid =".$_GET["productcatagoryid"];
    }
    $result = $conn->query($getProductsSQL) or die($conn->error);
    // fetch result to associative array
    $Products = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $Products;
}
//make a function to get the product detail
function getProductDetail($productid)
{
    // get connect to database
    $conn = dbconnect();
    // define a empty array
    $ProductDetails = array();
    $getgetProductDetailSQL = " SELECT * FROM `products` JOIN product_imagelibrary ON products.productid = product_imagelibrary.productid JOIN product_catagory ON products.productcatagoryid = product_catagory.productcatagoryid WHERE products.productid =".$productid;
    $result = $conn->query($getgetProductDetailSQL) or die($conn->error);
    // fetch result to associative array
    $ProductDetails = $result->fetch_all(MYSQLI_ASSOC);
    //close connection for safety
    $conn -> close();
    // return regions array
    return $ProductDetails;
}
function displayProductCategories()
{
    $ProductCategories = getProductCategories();
    ?>
        <div class="product-contain ">
            <div class="product-nav <?=!isset($_GET['productid'])?"sticky-top":"" ?>" >
                <h1><a href= "product.php">SHOP</a></h1>
                <div class="row align-items-start product-category ">
                    <?php
                        foreach($ProductCategories as $ProductCategory)
                        {
                            ?>  
                                <div class="col"><a href="product.php?productcatagoryid=<?php echo $ProductCategory['productcatagoryid']; ?>">
                                <?php echo $ProductCategory['p_catagoryname']; ?></a></div>
                            <?php
                        }
                    ?>
                </div>
            </div>
    <?php
}
function displayProductList()
{
    displayProductCategories();
    ?>
        <div class="container product-info">
                <div>
                    <h1>
                        <?php 
                            $products = getProducts();
                            if(isset($_GET['productcatagoryid']))
                            {
                                echo $products[0]['p_catagoryname'];
                            }
                        ?>
                    </h1>
                </div>
                <div class="row">
                    <?php 
                        foreach($products as $product)
                        {
                         ?>
                            <div class="col-md-3 col-sm-6" style="margin-top: 1.5em;">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="product.php?productid=<?php echo$product['productid'] ?>" class="image">
                                            <img class="pic-1" src=".<?php echo $product["productimg"] ?>">
                                            <img class="pic-2" src=".<?php echo $product["productimg2"] ?>">
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
                                        <h3 class="product-title"><a href="productdetail.html"><?php echo $product["productname"] ?></a></h3>
                                        <div class="product-price">€ <?php echo $product["productprice"] ?></div>
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

function displayProductDetail($productid)
{
    $ProductDetails = getProductDetail($productid);
    displayProductCategories();
    ?>
    <div class="small-container singele-product">
    <div class="row" style="margin: 0">
      <div class="col-4">
        <img style="width: 100%;" src=".<?= $ProductDetails[0]['productimg']?>" id="product-detail-image">
        <div class="small-img-row">
          <?php
            foreach($ProductDetails as $productDetail)
            {
                ?>
                    <div class="small-img-col">
                        <img src=".<?= $productDetail['imagelibraryname']?>" style="width: 100%;" class="small-product-image">
                    </div>
                <?php
            }
          ?>
        </div>
      </div>
      <div class="col-4">
        <p><?= $ProductDetails[0]['p_catagoryname']?></p>
        <h1><?= $ProductDetails[0]['productname']?></h1>
        <h4>€ <?= $ProductDetails[0]['productprice']?></h4>
        <select name="" id="">
          <option>Select size</option>
          <option>XS</option>
          <option>S</option>
          <option>M</option>
          <option>L</option>
          <option>XL</option>
        </select>

        <input type="number" value="1">
        <a href="" class="btn">Add to card</a>
        <div class="product-detail">
          <h3>Product detail</h3>
            <?= $ProductDetails[0]['productdesc']?>
        </div>
      </div>
    </div>
  </div>

  <script src="./js/scrip.js" type="text/javascript"></script>

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
            <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        </head>

        <body>
            <header class="header-contain" >
                <div class="header-container" id="navbar" >
                    <div class="d-flex align-items-center">
                        <div class="logo-contain">
                            <a href="index.php"><img src="./img/logo.png"></a>
                        </div>
                        <?php
                        if (isLoggedIn())
                        {
                            ?>
                            <div class="login-contain">
                                <a class="btn-login" href="account.php"><i class="bi bi-person-circle"></i></a>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="login-contain">
                                <a href="login.php" class="btn-login"><i class="bi bi-person-circle"></i></a>
                            </div>
                            <?php
                        }
                        ?>
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

function displayAdminHTMLhead()
{
    ?>
        <!DOCTYPE html>
        <html lang="en" dir="ltr">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dumbel Gym</title>
            <link rel="stylesheet" href="../css/styles.css">
            <!-- connect to bootrap cs -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
            <meta charset="utf-8">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
            <!-- End connect to bootrap cs -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
            <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        </head>

        <body>
            <header class="header-contain" >
                <div class="header-container" id="navbar" >
                    <div class="d-flex align-items-center">
                        <div class="logo-contain">
                           <h1 style="color:#45A29E;"> Hello Admin <h1>
                        </div>
                        <div>
                            <a href="../admin/index.php" class="nav-link" style="color: #C5C6C7; font-size: 1.3em;" > product list</a>
                        </div>
                        <?php
                        if (isLoggedIn())
                        {
                            ?>
                            <div class="login-contain">
                                <a class="btn-login" href="../inc/logout.inc.php" onclick="return confirm('Are you sure you want to log out')"><i class="bi bi-box-arrow-right"></i></a>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="login-contain">
                                <a href="login.php" class="btn-login"><i class="bi bi-person-circle"></i></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </header>
    <?php
}

function displayAdminHTMLFooter()
{
    ?>
    <footer>
        <div class="footer-contain">
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

/*--------------------upload files Functions---------------*/

function uploadFiles($uploadedFiles) 
{
    $files = array();
    $errors = array();
    $returnFiles = array();
    
    foreach ($uploadedFiles as $key => $values) {
        if(is_array($values))
        {
            foreach ($values as $index => $value) 
            {
                $files[$index][$key] = $value;
            }
        }
        else
        {
            $files[$key] = $values;
        }
    }
    //make folder uploads with date
    $uploadPath = "../uploads/" . date('d-m-Y', time());
    if (!is_dir($uploadPath)) 
    {
        mkdir($uploadPath, 0777, true);
    }
    //Upload more image
    if(is_array(reset($files))){
        foreach ($files as $file) 
        {
            $result = processUploadFile($file,$uploadPath);
            if($result['error']){
                $errors[] = $result['message'];
            }else{
                $returnFiles[] = $result['path'];
            }
        }
    }
    else
    { //Up 1 image
        $result = processUploadFile($files,$uploadPath);
        // if($result == NULL)
        // {
        //     echo "file not valid";
        // }
        // var_dump($result);exit;
        if($result['error'] == true)
        {
            return array(
                'errors' => $result['message']
            );
        }
        // if there in array['erros'] not true (not false by the type file)
        else
        {
            return array(
                'path' => $result['path']
            );
        }
    }
    return array(
        'errors' => $errors,
        'uploaded_files' => $returnFiles
    );
}

function processUploadFile($file,$uploadPath)
{
    $file = validateUploadFile($file, $uploadPath);
    if ($file != false) 
    {
        $file["name"] = str_replace(' ','_',$file["name"]);
        if(move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"])){
            return array(
                'error'=>false,
                'path' => str_replace('../', '/', $uploadPath) . '/' . $file["name"]
            );
        }
    }
    else
    {
        // return array(
        //     'error'=>false,
        //     'message' => "File upload" . basename($file["name"]) . " not valid."
        // );
        echo "file is not valid";
    }
}

function validateUploadFile($file, $uploadPath)
{
    // controleren of er de file is groter dan geaccepterende file Capaciteit
    if ($file['size'] > 2 * 1024 * 1024) 
    { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
        // echo "not valid files, maximum files upload is 2MB";
        return false;
    }
    //checken the type of files
    // make a array with file type name
    $validTypes = array("jpg", "jpeg", "png");
    // take out the file en get the file type
    $fileType = substr($file['name'], strrpos($file['name'], ".") + 1);
    //if file type not in the array $validTypes
    
    if (!in_array($fileType, $validTypes)) 
    {
        // echo "not valid files, type files must be (jpg, jpeg, png)";
        return false;
    }
    //Check file in de folder upload 
    $num = 0;
    $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
        $fileName = $fileName . "(" . $num . ")";
        $num++;
    }
    // if there have file with the same name then save new file + $num  
    if($num != 0){
        $fileName = substr($file['name'], 0, strrpos($file['name'], ".")). "(" . $num . ")";
    }else{
        $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    }
    //save new file + $num + file type
    $file['name'] =  $fileName . '.' . $fileType;
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

//Create user and insert their information into the database.
function createUser($conn, $username, $fname, $lname, $email, $pwd, $place, $postcode, $adress) 
{
    $sql = "INSERT INTO `users` (`useruid`, `firstname`, `lastname`, `useremail`, `password`, `userplaats`, `userpostcode`, `useradress`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header("Location: ../signup.php?error=stmtfailed1");
        exit();
    }

    //Encrypt the password
    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $fname, $lname, $email, $hashedpwd, $place, $postcode, $adress);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../signup.php?error=none");
    exit();
}

//printing for signup errors 
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

//check for empty fields
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

//check for the exictence of the username and if the password is correct
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
        // store the user info in session key user
        $_SESSION["user"] = $uidExist;
        // add new key isUserLoggedIn in user
        $_SESSION['user']["isUserLoggedIn"] = true;

        header("location: ../index.php");
        exit();
    }
}

//login errors check
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

//check if the user is logged in
function isLoggedIn()
{
    if($_SESSION['user']["isUserLoggedIn"] == true)
    {
        return true;
    }
    return false;
}

function updateUserInfo()
{
    $conn = dbconnect();

    if(isset($_POST["submit"]))
    {
        $id = $_SESSION['user']['userid'];

        $query = "
        UPDATE users 
        SET 
        useruid         = '" . $_POST['username'] . "',
        firstname       = '" . $_POST['firstname'] . "',
        lastname        = '" . $_POST['lastname'] . "',
        useremail       = '" . $_POST['email'] . "',
        userplaats      = '" . $_POST['place'] . "',
        userpostcode    = '" . $_POST['postcode'] . "',
        useradress      = '" . $_POST['adress'] . "'
        WHERE 
        userid          = " . $_SESSION['user']['userid'];

        //die($query);
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo "<p>Information updated";
        }
        else
        {

        }
    }
}
function LoginAdmin($conn, $username, $pwd)
{
    $uidExist = uidExist($conn, $username, $username);

    if ($uidExist == "misstodis")
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
        // store the user info in session key user
        $_SESSION["user"] = $uidExist;
        // add new key isUserLoggedIn in user
        $_SESSION['user']["isUserLoggedIn"] = true;

        header("location: ../admin/index.php");
        exit();
    }
}

function isAdminlogin()
{
    if($_SESSION['user']["isUserLoggedIn"] == "misstodis")
    {
        return true;
    }
    return false;
}

function profilePage()
{
    $conn = dbconnect();

    ?>
    <div class="account-main" >
        <div class="account-box1">
        <h3>Personalia</h3>
        <p>Full name: <?php echo $_SESSION['user']['firstname'];?> <?php echo $_SESSION['user']['lastname'];?></p>
        <p>Username: <?php echo $_SESSION['user']['useruid'];?></p>
        <p>Email: <?php echo $_SESSION['user']['useremail'];?></p>
        <p>Address: <?php echo $_SESSION['user']['useradress'];?></p>
        <p>plaats: <?php echo $_SESSION['user']['userplaats'];?></p>
        <p>Post Code: <?php echo $_SESSION['user']['userpostcode'];?></p>
        </div>
    </div>
    <div class="account-box3">
            <h3>Manage Login</h3>
            <label for="Reset-Login"><span>Reset Login</span> 
                <span>
                    <input id="Reset-Login" name="Reset-Login" type="checkbox">
                </span>
            </label><br>
                <p>User Name: <a href="#"><?php echo $_SESSION['user']['useruid'];?></a></p>
                <p>Email: <a href="#"><?php echo $_SESSION['user']['useremail'];?></a></p>
            <div class="form-group">
                    <label for="username" >Username:</label><br>
                    <input type="text" name="username" id="username" class="form-control">
                </div>  
                <div class="form-group">
                    <label for="email" >E-mail:</label><br>
                    <input type="text" name="email"class="form-control">
                </div>
        </div>
    <?php
}

//debuggin function
function myDump($varTodump, $exit = false, $varName = "", $file = false, $line = false)
{
    ?>
    <style>
    pre {
        background:#f1f1f1;
        color:#000;
        width: 80%;
        border: 1px solid #000;
        padding: 5px;
    }
    div.myDump
    {
        background:#f1f1f1;
        color:#000;
        width: 80%;
        border: 1px solid #000;
        padding: 5px;
    }
    </style>
    <div class="myDump">
    <?php
    if($file)
    {
        echo "<h4>File : " . $file . "</h4>";
    }
    if($line)
    {
        echo "<h4>Line : " . $line . "</h4>";
    }
    echo "<pre>";
    var_dump($varTodump);
    echo "</pre>";
    if($exit) die("done</div>");
    echo "</div>";
}

?>