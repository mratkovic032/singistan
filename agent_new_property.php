<?php
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Dodaj nekretninu</title>
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

                        <button class="navbar-btn nav-button wow fadeInRight" onclick="window.open('php/logout.php', '_self');" data-wow-delay="0.48s">Izloguj se</button>

                    </div>
                    <ul class="main-nav nav navbar-nav navbar-right">

                        <li class="wow fadeInDown" data-wow-delay="0.3s"><a class="navbar_link" href="index.php">Početna</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.4s"><a class="navbar_link" href="property_list.php">Nekretnine</a></li>
                        <?php
                        require 'php/database_connection.php';
                        $prep_notification = $db->prepare("SELECT agent.notifikacija FROM agent WHERE korisnicko_ime = ?;");
                        $prep_notification->execute([$_SESSION['username']]);
                        $res_notification = $prep_notification->fetchAll(PDO::FETCH_OBJ);
                        if ($res_notification[0]->notifikacija > 0) {

                            echo "<li class='wow fadeInDown' data-wow-delay='0.5s'><a class='navbar_link' href='agent_appointments.php'>Termini gledanja <sup style='color: #f00;'>" . $res_notification[0]->notifikacija . "</sup></a></li>\n";
                        } else {
                            echo "<li class='wow fadeInDown' data-wow-delay='0.5s'><a class='navbar_link' href='agent_appointments.php'>Termini gledanja</a></li>\n";
                        }
                        ?>
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
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="page-head" style="margin-top: 99px;"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Početna / Agent / Dodaj nekretninu</h1>               
                    </div>
                </div>
            </div>
        </div>

        <!-- property area -->
        <div class="content-area recent-property padding-top-40" style="background-color: #F4F4F4; padding-top: 60px; padding-bottom: 60px;">
            <div class="container">
                <div class="row">
                    <div class="box-for overflow col-md-8 col-xs-12 col-md-offset-2">
                        <div class="register-blocks col-md-12">
                            <?php
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'property_has_been_successfully_added') {
                                echo "<div class='alert alert-success' role='alert'>\n";
                                echo "<span class='success'>Uspesno ste dodali novu nekretninu!<br />\n";
                                echo "</div>\n";
                            }
                            ?>
                            <?php
                            if (isset($_GET["msg"]) && $_GET["msg"] == 'not_pic') {
                                echo "<div id='not_pic' class='alert alert-danger' role='alert' style='margin:10px 30px;'>\n";
                                echo "<span class='danger'>Slika mora biti u .jpg / .png / .gif formatu<br />\n";
                                echo "</div>\n";
                            }
                            ?> 
                            <h2>Nova nekretnina: </h2><span id="back_arrow" class="glyphicon glyphicon-arrow-up" style="margin-left: 15px; color: #FDC600; display: none;" data-toggle="tooltip" data-placement="right" title="Nazad"></span>
                        </div>                      
                        <div class="col-md-12 col-xs-12 register-blocks">

                            <form action="php/new_property.php" method="POST" enctype="multipart/form-data">
                                <div class="col-md-12" id="before_new_property_form">
                                    <div class="form-group">
                                        <label for="property_type">Tip nekretnine</label>
                                        <br>
                                        <select class="form-control" id="property_type" name="property_type">
                                            <option>- - -</option>
                                            <?php
                                            require 'php/database_connection.php';
                                            $prep = $db->prepare('SELECT * FROM tip_nekretnine;');
                                            $prep->execute();

                                            $res = $prep->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($res as $r) {
                                                echo "<option value='" . $r->id . "'>" . $r->tip . "</option>\n";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button class="btn btn-default btn-block" id="property_form_next" disabled>Dalje <span class="glyphicon glyphicon-arrow-down"></span></button>
                                </div>
                                <div class="col-md-12" style="display: none;" id="new_property_form">                                    
                                    <div class="form-group">
                                        <label for="opstina">Opština</label>
                                        <br>

                                        <select class="form-control" id="opstina" name="municipalities" required>
                                            <option>- - -</option>
                                            <?php
                                            require 'php/database_connection.php';
                                            $prep = $db->prepare('SELECT * FROM opstina ORDER BY naziv ASC;');
                                            $prep->execute();

                                            $res = $prep->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($res as $r) {
                                                echo "<option value='" . $r->id . "'>" . $r->naziv . "</option>\n";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="adresa">Adresa</label>
                                        <input type="text" class="form-control" id="adresa" name="address" required>
                                    </div>
                                    <div class="form-group" id="structure">
                                        <label for="struktura">Struktura</label>
                                        <br>
                                        <select class="form-control" name="structure">
                                            <option>- - -</option>
                                            <option value="Garsonjera">Garsonjera</option>
                                            <option value="Jednosobna">Jednosobna</option>
                                            <option value="Dvosobna">Dvosobna</option>
                                            <option value="Trosobna">Trosobna</option>
                                            <option value="Cetvorosobna">Cetvorosobna</option>
                                            <option value="Petosobna">Petosobna</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="parking">
                                        <label for="struktura">Parking</label>
                                        <br>
                                        <select class="form-control" name="parking">
                                            <option>- - -</option>
                                            <option value="Slobodna zona">Slobodna zona</option>
                                            <option value="Zona III">Zona III</option>
                                            <option value="Zona II">Zona II</option>
                                            <option value="Zona I">Zona I</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="m2">Površina</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="m2" name="quadrature" required>
                                            <span class="input-group-addon" style="border-radius: 0;">m<sup>2</sup></span>                                        
                                        </div>
                                    </div>
                                    <div class="form-group" id="accommodation">
                                        <label for="struktura">Nameštenost</label>
                                        <br />
                                        <select class="form-control" name="accommodation">
                                            <option>- - -</option>
                                            <option value="Namestena">Nameštena</option>
                                            <option value="Polunamestena">Polunameštena</option>
                                            <option value="Nenamestena">Nenameštena</option>                                                
                                        </select>
                                    </div>                                                                                
                                    <div class="form-group" id="heat">
                                        <label for="grejanje">Vrsta grejanja</label>
                                        <input type="text" class="form-control" name="heat">
                                    </div>
                                    <div class="form-group" id="floor">
                                        <label for="sprat">Sprat</label>
                                        <input type="number" class="form-control" name="floor">
                                    </div>
                                    <div class="form-group" id="building_floors" >
                                        <label for="spratnost">Ukupno spratova</label>
                                        <input type="number" class="form-control" name="building_floors">
                                    </div>
                                    <div class="form-group">
                                        <label for="cena">Cena</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="cena" name="price" required>
                                            <span class="input-group-addon" style="border-radius: 0;">€</span>                                        
                                        </div>
                                    </div>
                                    <div class="form-group" id="multiple_pics_div" style="margin-top: 15px;">
                                        <label for="property-images">Izaberi sliku</label>
                                        <span id="add_pic_input" class="glyphicon glyphicon-plus" style="margin-left: 10px; cursor: pointer; color: #FDC600" data-toggle="tooltip" data-placement="top" title="Dodaj polje za unos slike"></span>
                                        <input class="form-control-file" type="file" name="file[]">
                                    </div>
                                        <span class="help-block">Klknite na plus ukoliko zelite da upload-ujete više slika</span>
                                    <div class="form-group">                                                               
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-default btn-block">Unesi <span class="glyphicon glyphicon-home" aria-hidden="true"> </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
            $(document).ready(function() {
                $('#not_pic').delay(3500).slideUp();
            });
        </script>

    </body>
</html>
