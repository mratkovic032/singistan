<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Kontakt</title>
        <meta name="description" content="Singi Stan je agencija koja se bavi prometom nekretnina u Beogradu.">        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>


        <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">        
        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/fontello.css">
        <link href="assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
        <link href="assets/css/animate.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/bootstrap-select.min.css"> 
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/icheck.min_all.css">
        <link rel="stylesheet" href="assets/css/price-range.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.css">  
        <link rel="stylesheet" href="assets/css/owl.theme.css">
        <link rel="stylesheet" href="assets/css/owl.transitions.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/nas_stil.css">
        <script src="assets/js/google_maps.js" type="text/javascript"></script>        
    </head>
    <body id="top_of_the_page">

        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <!-- Body content -->
        <nav class="navbar navbar-default navbar-fixed-top  ">
            <div class="container" id="nav_div">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" id="big_logo"><img src="assets/img/logo.png" alt="logo"></a>
                    <a class="navbar-brand" href="index.php" id="small_logo"><img src="assets/img/favicon.png" alt="logo" id="small_logo_pic"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation" style="background-color: #fff;">
                    <div class="button navbar-right">
                        <?php
                        session_start();
                        if (!isset($_SESSION['username'])) {
                            ?>
                            <button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('login.php', '_self');" data-wow-delay="0.45s">Uloguj se</button>
                            <button class="navbar-btn nav-button wow fadeInRight" onclick="window.open('register.php', '_self');" data-wow-delay="0.48s">Registruj se</button>
                            <?php
                        } else {
                            ?>
                            <button class="navbar-btn nav-button wow fadeInRight" onclick="window.open('php/logout.php', '_self');" data-wow-delay="0.48s">Izloguj se</button>
                        <?php } ?>
                    </div>
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="wow fadeInDown" data-wow-delay="0.3s"><a class="navbar_link" href="index.php">Početna</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.4s"><a class="navbar_link" href="property_list.php">Nekretnine</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.5s"><a class="navbar_link" href="contact.php">Kontakt</a></li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            ?>                        
                            <li class="wow fadeInDown" data-wow-delay="0.6s"><a class="navbar_link" href="favourites.php">Lista želja</a></li>
                            <li class="wow fadeInDown" data-wow-delay="0.7s"><a class="navbar_link" href="profile.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['username']; ?></a></li>
                            <?php
                        }
                        ?>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="page-head" style="margin-top: 99px;"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Početna / Kontakt</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                    <div class="col-md-8 col-md-offset-2"> 
                        <?php
                        if (isset($_GET["msg"]) && $_GET["msg"] == 'email_has_been_sent') {
                            echo "<div class='alert alert-success' role='alert'>\n";
                            echo "<span class='success'>Vasa poruka je uspesno poslata!<br />\n";
                            echo "</div>\n";
                        }                        
                        ?> 
                        <div class="" id="contact1"> 
                            <h2>Pitajte nas</h2>
                            <form action="php/contact_question.php" method="POST">
                                <div class="row">
                                    <?php
                                    if (!isset($_SESSION['username'])) {
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstname">Ime</label>
                                                <input type="text" class="form-control" id="firstname" name="name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lastname">Prezime</label>
                                                <input type="text" class="form-control" id="lastname" name="surname">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="text" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="subject">Naslov poruke</label>
                                                <input type="text" class="form-control" id="subject" name="subject">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="subject">Naslov poruke</label>
                                                <input type="text" class="form-control" id="subject" name="subject">
                                            </div>
                                        </div>
                                    <?php } ?>                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="message">Poruka</label>
                                            <textarea id="message" class="form-control" rows="5" name="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-block" name="submit"><i class="fa fa-envelope-o"></i> Pošalji</button>
                                    </div>
                                    <hr>                                    

                                </div>
                                <!-- /.row -->
                            </form>
                        </div>
                    </div>    
                </div>

            </div>
        </div>                
        
        <!-- Google Map -->
        <div id="googleMap"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy70D14WJrMBJWZ6NemVDNnyVGsz1Vm1U&callback=initMap"></script>
        
        <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">                        
                        <div class="col-sm-4">
                            <h3><i class="fa fa-map-marker"></i> Adresa</h3>
                            <p>Danijelova 32
                                <br>Voždovac
                                <br>Beograd 
                                <br>
                                <strong>Srbija</strong>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <h3><i class="fa fa-phone"></i> Call centar</h3>
                            <p class="text-muted">Ukoliko imate nekih pitanja ili želite da zakažete gledanje nekretnine telefonom, možete nas kontaktirati putem ovog broja.</p>
                            <p><strong>+381 11 235684</strong></p>
                        </div>                        
                        <div class="col-sm-4">
                            <h3><i class="fa fa-envelope"></i> E-mail</h3>
                            <p class="text-muted">Možete nas kontaktirati i putem mail-a ili možete popuniti formu u nastavku.</p>
                            <ul>
                                <li><strong><a href="mailto:">office@singistan.ga</a></strong>   </li>

                            </ul>
                        </div>                        
                    </div>                
            </div>
        </div>
        
        <!-- Footer area-->
        <div class="footer-area">

            <div class=" footer">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Singi Stan</h4>
                                <div class="footer-title-line"></div>


                                <p>Garantovano vas dovodimo do željenog doma, u rekordnom vremenu.</p>
                                <ul class="footer-adress">
                                    <li><i class="pe-7s-map-marker strong"> </i>11000 Beograd, Danijelova 32</li>
                                    <li><i class="pe-7s-mail strong"> </i> office@singistan.tk</li>
                                    <li><i class="pe-7s-call strong"> </i>+381 11 235684</li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer">
                                <h4>Prečice </h4>
                                <div class="footer-title-line"></div>
                                <ul class="footer-menu">
                                    <li><a href="index.php">Početna</a>  </li>
                                    <li><a href="property_list.php">Nekretnine</a>  </li> 
                                    <li><a href="contact.php">Kontakt </a></li> 
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 wow fadeInRight animated">
                            <div class="single-footer news-letter">
                                <h4>Pretplati se</h4>
                                <div class="footer-title-line"></div>
                                <p>Ukoliko želite da dobijate najnovije nekretnine koje se prodaju na vašu e-mail adresu, prijavite se ispod.</p>

                                <form>
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Vaš e-mail ... ">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary subscribe" type="button"><i class="pe-7s-paper-plane pe-2x"></i></button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </form> 


                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footer-copy text-center">
                <div class="container">
                    <div class="row">
                        <div class="pull-left">
                            <span> (C) <b>SingiCompany</b> , All rights reserved 2018  </span> 
                        </div>
                        <a href="#top_of_the_page" class="pull-right">
                            <span class="up_arrow" data-toggle="tooltip" data-placement="top" title="Back on top" style="margin-bottom: 30px; font-size: 20px;"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </a> 
                    </div>
                </div>
            </div>

        </div>
        
        <script src="assets/js/modernizr-2.6.2.min.js"></script>

        <script src="assets/js/jquery-1.10.2.min.js"></script> 
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="assets/js/easypiechart.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/wow.js"></script>

        <script src="assets/js/icheck.min.js"></script>
        <script src="assets/js/price-range.js"></script>

        <script src="assets/js/main.js"></script>
        <script src="assets/js/navbar.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $('.alert-success').delay(3000).slideUp();
            });
        </script>
        
    </body>
</html>