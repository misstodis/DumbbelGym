<?php
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



?>

