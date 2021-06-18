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
    if(!isset($_GET["productcatagoryid"]))
    {
        $getProductsSQL = "SELECT * FROM `products`";
    }
    if(isset($_GET["productcatagoryid"]))
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
                                <div class="col"><a href="productList.php?productcatagoryid=<?php echo $ProductCategory['productcatagoryid']; ?>">
                                <?php echo $ProductCategory['p_catagoryname']; ?></a></div>
                            <?php
                        }
                    ?>
                </div>
            </div>
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
                                        <a href="productdetail.html" class="image">
                                            <img class="pic-1" src="<?php echo $product["productimg"] ?>">
                                            <img class="pic-2" src="<?php echo $product["productimg2"] ?>">
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
                                        <div class="product-price"><?php echo $product["productprice"] ?></div>
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
            <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
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
/*--------------------upload files Functions---------------*/

function uploadFiles($uploadedFiles)
{
    $files = array();
    $errors = array();
    $returnFiles = array();

    foreach($uploadedFiles as $key => $values)
    {
       if (is_array($values)) 
       {
           foreach($values as $index => $value)
           {
               $files[$index][$key]= $value;
           }
       }
       else
       {
           $files[$key] = $values;
       }
    }
    // maken nieuw folder met naam "uploadfile" + datum
    $uploadPath = "./uploads/". date('d-m-Y',time());
    if(!is_dir($uploadPath))
    {
        mkdir($uploadPath,0777,true);
    }
    if (is_array(reset($files))) 
    {
        foreach( $files as $file)
        {
            $result = validateUploadFile($file, $uploadPath);
            if($result['error'])
            {
                $errors[] = $result['message'];
            }
            else
            {
                $returnFiles[] =  $result['path'];
            }
        }
    }
    else
    {
        $result = processUploadFile($files,$uploadPath);
        if($result['error'])
        {
            return array('errors'=> $result['message']);
        }
        else
        {
            return array('path'=> $result['path']);
        }

    }
    return array(
        'errors' => $errors, 'uploaded_files'=> $returnFiles
    );
}

function processUploadFile($file,$uploadPath){
    $file = validateUploadFile($file, $uploadPath);
    if ($file != false) {
        $file["name"] = str_replace(' ','_',$file["name"]);
        if(move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"])){
            return array(
                'error'=>false,
                'path' => str_replace('../', '/', $uploadPath) . '/' . $file["name"]
            );
        }
    }else{
        return array(
            'error'=>false,
            'message' => "File upload " . basename($file["name"]) . " not invalid"
        );
    }
}
function validateUploadFile($file, $uploadPath)
{
    // controleren of er de file is groter dan geaccepterende file Capaciteit
    if ($file['size'] > 2 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
        return false;
    }
    //Kiểm tra xem kiểu file có hợp lệ không?
    $validTypes = array("jpg", "jpeg", "png", "bmp","xlsx","xls");
    $fileType = strtolower(substr($file['name'], strrpos($file['name'], ".") + 1));
    if (!in_array($fileType, $validTypes)) {
        return false;
    }
    //Check xem file đã tồn tại chưa? Nếu tồn tại thì đổi tên
    $num = 0;
    $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
        $fileName = $fileName . "(" . $num . ")";
        $num++;
    }
    if($num != 0){
        $fileName = substr($file['name'], 0, strrpos($file['name'], ".")). "(" . $num . ")";
    }else{
        $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    }
    $file['name'] =  $fileName . '.' . $fileType;
    return $file;
}
