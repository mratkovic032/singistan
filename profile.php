<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Profil</title>
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

    </head>
    <body id="top_of_the_page">
        <?php
        session_start();


        // if no valid session is found then the user is not logged in and will
        // receive a access denied message and will be redirected to the login page.
        if (!isset($_SESSION['username'])) {

            header("Refresh: 4; url=login.php");
            include_once '404.php';

            exit(); // Quit the script.
        }
        ?>
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <!-- php sa bazom -->

        <?php
        require 'php/database_connection.php';

        if ($_SESSION['user_type'] === "kupac") {
            $prep = $db->prepare('SELECT * FROM kupac WHERE korisnicko_ime=?;');
        } elseif ($_SESSION['user_type'] === "agent") {
            $prep = $db->prepare('SELECT * FROM agent WHERE korisnicko_ime=?;');
        }
        $prep->execute([$_SESSION['username']]);

        $res = $prep->fetchAll(PDO::FETCH_OBJ);
        ?>
        <!-- Body content -->
        <!--Nav bar -->


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
                        <?php
                        if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && ($_SESSION['user_type'] === "kupac"))) {
                            ?>
                            <li class="wow fadeInDown" data-wow-delay="0.5s"><a class="navbar_link" href="contact.php">Kontakt</a></li>
                            <?php
                        }
                        if (isset($_SESSION['username'])) {
                            if ($_SESSION['user_type'] === "kupac") {
                                ?>                        
                                <li class="wow fadeInDown" data-wow-delay="0.6s"><a class="navbar_link" href="favourites.php">Lista želja</a></li>
                                <li class="wow fadeInDown" data-wow-delay="0.7s"><a class="navbar_link" href="profile.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['username']; ?></a></li>
                                <?php
                            } else if ($_SESSION['user_type'] === "agent") {
                                ?>
                                <li class="wow fadeInDown" data-wow-delay="0.5s"><a class="navbar_link" href="agent_appointments.php">Termini gledanja</a></li>
                                <li class="wow fadeInDown dropdown ymm-sw " data-wow-delay="0.6s">
                                    <a href="index.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Opcije <b class="caret"></b></a>
                                    <ul class="dropdown-menu navbar-nav">
                                        <li>
                                            <a class="navbar_link" href="agent_new_property.php">Dodaj nekretninu</a>
                                        </li>
                                        <li>
                                            <a class="navbar_link" href="customers.php">Lista kupaca</a>
                                        </li>
                                        <li>
                                            <a class="navbar_link" href="agent_contract.php">Ugovori</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.7s"><a class="navbar_link" href="profile.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['username']; ?></a></li>  
                                <?php
                            }
                        }
                        ?>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <!-- End of nav bar -->

        <div class="page-head" style="margin-top: 100px;"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Početna / <span class="orange strong"><?php echo $res[0]->ime . " " . $res[0]->prezime ?></span></h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->
        <!-- property area -->
        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;

            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <form action="php/change_profile.php" method="post" enctype="multipart/form-data">
                            <div class="profiel-header">
                                <h3>
                                    <b>PREGLED&nbsp; </b>PROFILA  <br>
                                    <?php
                                    if ($_SESSION['user_type'] === "kupac") {
                                        echo "<small>Navedene informacije se mogu koristiti u svrhe sastavljanja ugovora o kupoprodaji</small>";
                                    }
                                    ?>
                                </h3>   
                                <hr>
                                <hr>
                            </div>
                            <?php
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
                                echo "<div id='succes_profile_change' class='alert alert-success' role='alert' style='margin:10px 30px;'>\n";
                                echo "<span class='success'>Uspesno ste izmenili podatke!<br />\n";
                                echo "</div>\n";
                            }
                            ?> 
                            <?php
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'not_pic') {
                                echo "<div id='not_pic' class='alert alert-danger' role='alert' style='margin:10px 30px;'>\n";
                                echo "<span class='danger'>Slika morabiti u .jpg / .png / .gif formatu<br />\n";
                                echo "</div>\n";
                            }
                            ?> 
                            <div class="clear">
                                <div class="col-md-4 col-md-offset-1" style="margin-top: 22px;">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <?php
                                            if ($res[0]->putanja_slike != null) {
                                                echo "<img src='" . $res[0]->putanja_slike . "' class='picture-src' id='wizardPicturePreview' title='' alt='profilna slika' />\n";
                                                echo "<input type='file' name='file' id='wizard-picture' />\n";
                                            } else {
                                                echo "<img src='assets/img/profile_blank.jpg' class='picture-src' id='wizardPicturePreview' title='' alt='profilna slika' />\n";
                                                echo "<input type='file' name='file' id='wizard-picture' />\n";
                                            }
                                            ?>
<!--                                            <img src="assets/img/profile_blank.jpg" class="picture-src" id="wizardPicturePreview" title=""/>
                                            <input type="file" name="file" id="wizard-picture">-->
                                        </div>
                                        <?php
                                        if ($res[0]->putanja_slike != null) {
                                            echo "<label>Promeni profilnu sliku</label>\n";
                                        } else {
                                            echo "<label>Postavi profilnu sliku</label>\n";
                                        }
                                        ?>
                                        
                                    </div>
                                </div>

                                <div class="col-md-3 padding-top-25">

                                    <div class="form-group">
                                        <label>Ime : <small hidden> (obavezno)</small></label>
                                        <?php echo "<input name='firstname' type='text' class='form-control' value='" . $res[0]->ime . "' readonly>\n"; ?> 
                                    </div>
                                    <div class="form-group">
                                        <label>JMBG : <small hidden> (obavezno)</small></label>
                                        <?php echo "<input name='jmbg' type='number' class='form-control' required readonly value='" . $res[0]->jmbg . "'> \n"; ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Email : <small hidden> (obavezno)</small></label>
                                        <?php echo "<input name='email' type='email' class='form-control' required readonly value='" . $res[0]->email . "'> \n"; ?>
                                    </div> 
                                    
                                </div>
                                <div class="col-md-3 padding-top-25">
                                    <div class="form-group">
                                        <label>Prezime : <small hidden> (obavezno)</small></label>
                                        <?php echo " <input name='lastname' type='text' class='form-control' required readonly value='" . $res[0]->prezime . "'> \n"; ?>
                                    </div> 
                                    <div class="form-group">
                                        <label>Adresa : </label><small hidden> (obavezno)</small>
                                        <?php echo "<input name='address' type='text' class='form-control' readonly value='" . $res[0]->adresa . "'> \n"; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Telefon</label><small hidden> (obavezno)</small>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-radius: 0;">+381</span>  
                                            <?php echo "<input name='tel' type='text' class='form-control' readonly value='" . substr($res[0]->telefon, 4) . "'> \n"; ?>                                  
                                        </div>
                                    </div>
                                    
                                </div>  

                            </div>

                            <div class="clear">
                                <br>

                                <br>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Korisničko ime : <small hidden> (obavezno)</small></label>
                                        <?php echo "<input name='username' type='text' class='form-control' required readonly value='" . $res[0]->korisnicko_ime . "'> \n"; ?>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-5 col-sm-offset-1">
                                    

                                    <div id="sifra1" class="form-group sifra">
                                        <label>Lozinka : <small hidden> (obavezno)</small></label>
                                        <input name="password" id="password" type="password" class="form-control" required readonly>
                                    </div>
                                </div>  

                                <div class="col-sm-5">
                                    <div id="sifra2" class="form-group sifra">
                                        <label>Potvrdi lozinku : <small hidden> (obavezno)</small></label>
                                        <input type="password" id="confirm_password" class="form-control" required readonly>

                                        <span id='message'></span>
                                    </div>                                                                                                            

                                </div>

                            </div>

                            <div class="col-sm-5 col-sm-offset-1">
                                <br>
                                <input type='button' id="edit_profile" class='btn btn-finish btn-primary' name='edit' value='Izmeni podatke' />
                                <input type='hidden' id="change_profile" class='btn btn-finish btn-primary' name='change_profile' value='Unesi izmene' />

                            </div>
                            <br>
                            <br>
                            <br>
                        </form>

                    </div>
                </div><!-- end row -->

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
        <script src="assets/js/profile.js" type="text/javascript"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/scroll_up.js"></script>
        <script src="assets/js/navbar.js" type="text/javascript"></script>
    </body>
</html>