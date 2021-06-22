<?php
$funtionsFile = "../inc/funtion.php";
// if the funtion not exist
if(!file_exists($funtionsFile))
{
    die("missing funtions file !!!") ;
}

// include the funtions file 
require($funtionsFile);

// display head html
displayAdminHTMLhead();
?>
<?php
    if(isAdminlogin() == true)
    {
        //check if the action == add of edit
        if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit'))
        {
            $errorMessages = array();
            $galleryImages = array();
            // check input
            if (isset($_POST['upload-productname'])  && empty($_POST['upload-productname'])) 
            {
                $errorMessages[] = "missing name product";
            }
            if (isset($_POST['upload-productprice']) && empty($_POST['upload-productprice'])) 
            {
                $errorMessages[] = "missing product price";
            } 
            if (!empty($_POST['upload-productprice']) && is_numeric(str_replace('.', '', $_POST['upload-productprice'])) == false) 
            {
                $errorMessages[] = "not invalid price";
            }
            if(isset($_POST['upload-productcategories']) && empty($_POST['upload-productcategories']))
            {
                $errorMessages[] = "missing product categories";
            }
            if(isset($_FILES['upload_image_product']) && !empty($_FILES['upload_image_product']['name'][0]))
            {
                $uploadedFiles = $_FILES['upload_image_product'];
                $result = uploadFiles($uploadedFiles);
                $image = $result['path'];
            }
            // using for edit product, if the user not change the image
            //checken variable image a bove if there nothingn then use the current image 
            elseif(!isset($image) && !empty($_POST['upload_image_product']))
            {
                $image = $_POST['upload_image_product'];
            }
            elseif(!isset($image) && empty($image))
            {
                $errorMessages[] = "missing main image";
            }

            if(isset($_FILES['upload_imageTwo_product']) && !empty($_FILES['upload_imageTwo_product']['name'][0]))
            {
                $uploadedFiles = $_FILES['upload_imageTwo_product'];
                $result = uploadFiles($uploadedFiles);
                $imageTwo = $result['path'];
            }
            // using for edit product, if the user not change the image
            //checken variable image a bove if there nothingn then use the current image 
            elseif(!isset($imageTwo) && !empty($_POST['upload_imageTwo_product']))
            {
                $imageTwo = $_POST['upload_imageTwo_product'];
            }
            elseif(!isset($imageTwo) && empty($imageTwo))
            {
                $errorMessages[] = "missing second image";
            }
            // checken the input gallery image
            if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) 
            {
                $uploadedFiles = $_FILES['gallery'];
                $result = uploadFiles($uploadedFiles);
                $galleryImages = $result['uploaded_files'];
            }
            if($_GET['action'] == "add")
            {
                if(isset($_FILES['gallery']) && empty($_FILES['gallery']['name'][0])) 
                {
                    $errorMessages[] = "missing libary image";
                }
            }
            if(isset($_FILES['productdscontent']) && empty($_FILES['productdscontent']))
            {
                $errorMessages[] = "missing product content";
            }
            if(count($errorMessages) > 0)
            {
                ?> <div class="up-load-succes"> <?php
                ?>
                    <h2>can't upload file</h2>
                <?php
                for($i=0 ; $i < count($errorMessages) ; $i++)
                {
                    echo $errorMessages[$i] . "<br/>";
                }
                ?>
                    <a href ="./product_editing.php">go back to product upload</a>
                    <a href ="./index.php">go back to product list</a>
                <?php
                ?> </div> <?php
            }
            // if there zero errors
            if(count($errorMessages) == 0)
            {   
                //connect to database
                $con = dbconnect();
                //check if action = edit en exsit changeid in URL
                if($_GET['action'] == 'edit' && !empty($_GET['changeid']))
                {
                    $result = mysqli_query(
                        $con,"UPDATE  `products` SET `productcatagoryid`= '". $_POST['upload-productcategories'] ."',`productname`= '". $_POST['upload-productname']. "' 
                        ,`productprice`= '". $_POST['upload-productprice']. "',`productimg` = '".$image."'
                        ,`productimg2`='".$imageTwo."',`productdesc`='". $_POST['productdscontent'] ."'
                        WHERE `products`.`productid`= ".$_GET["changeid"]
                    );
                }
                // else is addd product
                if($_GET['action'] == 'add')
                {
                    $result = mysqli_query($con,"INSERT INTO `products` (`productid`,`productcatagoryid`,`productname`,`productprice`,`productimg`,`productimg2`,`productdesc`)
                    VALUES (NULL, '" . $_POST['upload-productcategories'] . "','" . $_POST['upload-productname'] . "','" . $_POST['upload-productprice'] . "','" .$image . "','" . $imageTwo . "','" . $_POST['productdscontent'] . "')");
                }
                //if upload to product or insert to product to database finis then
                if($result == true)
                {
                    //insert image galery into product_imagelibrary database
                    //check empty $galleryImages
                    if(!empty($galleryImages))
                    {
                        //if action is edit 
                        if($_GET['action'] == 'edit' && !empty($_GET['changeid']))
                        {
                            $productid = $_GET['changeid'];
                        }
                        //if action = add
                        elseif($_GET['action'] == 'add' )
                        {
                            $productid = $con->insert_id; // get the id product this send to database
                        }
                        $insertValues ="";
                        foreach ($galleryImages as $path) 
                        {
                            if (empty($insertValues)) 
                            {
                                $insertValues = "(NULL, " . $productid . ", '" . $path ."'  )";
                            } 
                            else 
                            {
                                $insertValues .= ",(NULL, " . $productid . ", '" . $path ."' )";
                            }
                        }
                        $result = mysqli_query($con, "INSERT INTO `product_imagelibrary` (`imagelibraryid`, `productid`, `imagelibraryname`) VALUES $insertValues" );
                    }
                }
                ?>
                    <div class="up-load-succes">
                        <h2>upload succesful</h2>
                        <a href ="./product_editing.php">more upload</a>
                        <a href ="./index.php">go back to product list</a>
                    </div>
                <?php
            }

        }
        else
        {
            if(!empty($_GET['changeid']))
            {
                $con = dbconnect();
                $result = mysqli_query($con, "SELECT * FROM products JOIN product_imagelibrary ON products.productid = product_imagelibrary.productid JOIN product_catagory ON products.productcatagoryid = product_catagory.productcatagoryid WHERE products.productid =".$_GET["changeid"]);
                $productChange = $result->fetch_all(MYSQLI_ASSOC);
            }
            else{}
            ?> 
                <div class="container">
                    <div style="text-align: center; margin-top: 1.2em ;background-color: #C5C6C7;">
                        <!-- if exist $_GET['changeid'] then change product else add product  -->
                        <h2><?= !empty($_GET['changeid'])?"CHANGE PRODUCT":"ADD PRODUCT"?></h2>
                    </div>
                    <div class="list-group listgroup-flush">
                        <div class="card border-0 mb-3 shadow">
                            <div class="list-group">
                                <!-- if isset variable $productChange from URL the action=edit&changeid , else action= add -->
                                <form class="product-form-A" id="product-form" method="POST" action="<?=!empty($productChange)?"?action=edit&changeid=".$_GET['changeid']:"?action=add"?>" enctype="multipart/form-data">
                                    <input class="btn btn-primary btn-lg" type="submit" title="save product" value="save product"/>
                                    <div class="product-form-input">
                                        <label>name product</label>
                                        <input type="text" name="upload-productname" value="<?= !empty($productChange)?$productChange[0]['productname']:""?>"/>
                                    </div>
                                    <div class="product-form-input">
                                        <label>price product</label>
                                        <input type="text" name="upload-productprice" value="<?= !empty($productChange)?$productChange[0]['productprice']:""?>"/>
                                    </div>
                                    <div class="product-form-input">
                                        <label>product categories</label><br/>
                                        <select name="upload-productcategories" id="">
                                            <option value="<?= !empty($productChange)?$productChange[0]['productcatagoryid']:""?>"><?= !empty($productChange)?$productChange[0]['p_catagoryname']:"Choose product category"?></option>
                                            <option value="1">Clothes</option>
                                            <option value="2">Sports Nutrition</option>
                                            <option value="3">Material</option>
                                        </select>
                                    </div>
                                    <div class="product-form-input">
                                        <label>main product image</label>
                                        <input type="file" name="upload_image_product" class="form-control" accept="image/x-png,image/gif,image/jpeg" />
                                        <?php 
                                            if(!empty($productChange))
                                            { 
                                                ?> 
                                                    <img src="..<?=$productChange[0]['productimg']; ?>">
                                                    <!-- make a input if the user not change the mainimage then user the current image  -->
                                                    <input type ="hide" name="upload_image_product" value ="<?= $productChange[0]['productimg'] ?>">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="product-form-input">
                                        <label>Second product image</label>
                                        <input type="file" name="upload_imageTwo_product" class="form-control" accept="image/x-png,image/gif,image/jpeg" />
                                        <?php 
                                            if(!empty($productChange))
                                            { 
                                                ?>
                                                    <img src="..<?= $productChange[0]['productimg2']; ?>">
                                                    <!-- make a input if the user not change the mainimage then user the current image  -->
                                                    <input type ="hide" name="upload_imageTwo_product" value ="<?= $productChange[0]['productimg2'] ?>">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="product-form-input">
                                        <label>libary product image</label>
                                        <input multiple="" type="file" name="gallery[]" class="form-control" accept="image/x-png,image/gif,image/jpeg" />
                                        <?php
                                            if(!empty($productChange))
                                            {
                                                ?><div class="display-image-gallery"><?php
                                                foreach($productChange as $productChangeImageGl)
                                                {
                                                    ?> 
                                                        <div class="image-gallery">
                                                            <a href="../inc/imageGallery_delete.php?deleteGLid=<?php echo $productChangeImageGl['imagelibraryid'] ?>">delete</a>
                                                            <img src="..<?php echo $productChangeImageGl['imagelibraryname']?>">
                                                        </div>
                                                    <?php
                                                }
                                            ?> </div> <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="product-form-input">
                                        <label>product descripton</label>
                                        <textarea name="productdscontent" > <?= !empty($productChange)?$productChange[0]['productdesc']:""?></textarea>
                                        <script>
                                            CKEDITOR.replace( 'productdscontent' );
                                        </script>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>      
            <?php
        }
    }
    else
    {
        ?> 
            <div  class="ask-adimlogin">
                <a href="../login.php">
                    <h2>Login As Admin first</h2>
                </a>
            </div>
        <?php
        displayAdminHTMLFooter();
    }
?>
<?php displayAdminHTMLFooter();?>