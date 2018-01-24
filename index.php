<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Početna</title>
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
        <?php
        session_start();
         if (isset($_SESSION['username']) && $_SESSION['username'] == "gazda") {
                header("Location:ceo_contracts.php");
                exit(); // Quit the script.
            }

        ?>

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
                                <?php
                            }
                        }
                        ?>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <!-- End of nav bar -->

        <div class="slider-area" id="welcome_pic">
            <div class="slider-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                            <h2>lako i brzo do novog doma</h2>

                            <div id="trazi" class="search-form wow pulse" data-wow-delay="0.8s">

                                <form action="filter_view.php" method="POST" class=" form-inline">
                                    <button class="btn  toggle-btn" type="button"><i class="fa fa-bars"></i></button>

                                    <div class="form-group">                                     
                                        <select id="basic" title="Izaberi tip nekretnine" class="selectpicker show-tick form-control" name="property_type">
                                            <?php
                                            require 'php/database_connection.php';
                                            $prep_property_type = $db->prepare('SELECT * FROM tip_nekretnine;');
                                            $prep_property_type->execute();

                                            $res_property_type = $prep_property_type->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($res_property_type as $type) {
                                                echo "<option value='" . $type->id . "'>" . $type->tip . "</option>\n";
                                            }
                                            ?> 
                                        </select>
                                    </div>

                                    <div class="form-group">                                   
                                        <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Izaberi opštinu" name="municipalities">
                                            <?php
                                            require 'php/database_connection.php';
                                            $prep_municipality = $db->prepare('SELECT * FROM opstina ORDER BY naziv ASC;');
                                            $prep_municipality->execute();

                                            $res_municipality = $prep_municipality->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($res_municipality as $municipality) {
                                                echo "<option value='" . $municipality->id . "'>" . $municipality->naziv . "</option>\n";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <button class="btn search-btn" type="submit" name="submit"><i class="fa fa-search"></i></button>

                                    <div style="display: none;" class="search-toggle">

                                        <div class="search-row">   

                                            <div class="form-group mar-r-20">
                                                <label for="price-range">Cena od - do (EUR) :</label>
                                                <input type="text" class="span2" data-slider-min="10000" 
                                                       data-slider-max="500000" data-slider-step="10000" 
                                                       data-slider-value="[30000,200000]" id="price-range" name="price_range"><br />
                                                <b class="pull-left color">10.000€</b> 
                                                <b class="pull-right color">500.000€</b>
                                            </div> 

                                            <div class="form-group mar-l-20">
                                                <label for="property-geo">Kvadratura (m<sup>2</sup>) :</label>
                                                <input type="text" class="span2"  data-slider-min="0" 
                                                       data-slider-max="400" data-slider-step="5" 
                                                       data-slider-value="[50,250]" id="property-geo" name="quadrature_range"><br />
                                                <b class="pull-left color">0m<sup>2</sup></b> 
                                                <b class="pull-right color">600m<sup>2</sup></b>
                                            </div>
                                        </div>


                                        <br>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="col-md-4">                                                    
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="structure[]" value="Garsonjera"> Garsonjera
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="structure[]" value="Jednosobna"> Jednosobna
                                                                </label>
                                                            </div>
                                                        </div>  

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="structure[]" value="Dvosobna"> Dvosobna
                                                                </label>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="structure[]" value="Trosobna"> Trosobna
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="structure[]" value="Cetvorosobna"> Četvorosobna
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="structure[]" value="Petosobna"> Petosobna
                                                                </label>
                                                            </div>
                                                        </div>                                                    
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="parking[]" value="Zona I"> Zona I
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="parking[]" value="Zona II"> Zona II
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="parking[]" value="Zona III"> Zona III
                                                                </label>
                                                            </div>
                                                        </div>  

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="parking[]" value="Slobodna zona"> Slobodna zona
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="accommodation[]" value="Namestena"> Nameštena
                                                                </label>
                                                            </div>
                                                        </div>  

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="accommodation[]" value="Nenamestena"> Nenameštena
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="accommodation[]" value="Polunamestena"> Polunameštena
                                                                </label>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <br>
                                        <hr>                                                                
                                    </div>
                                </form>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>            
        </div>                

        <!-- Count area -->
        <div class="count-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <h2>Imajte poverenja u nas</h2> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 percent-blocks m-main" data-waypoint-scroll="true">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-users"></span>
                                    </div>
                                    <div class="chart" data-percent="700">
                                        <h2 class="percent" id="counter">0</h2>
                                        <h5>Zadovoljnih kupaca</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-home"></span>
                                    </div>
                                    <div class="chart" data-percent="1200">
                                        <h2 class="percent" id="counter1">0</h2>
                                        <h5>Nekretnina u bazi</h5>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-flag"></span>
                                    </div>
                                    <div class="chart" data-percent="120">
                                        <h2 class="percent" id="counter2">0</h2>
                                        <h5>Agenata</h5>
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-sm-3 col-xs-6">
                                <div class="count-item">
                                    <div class="count-item-circle">
                                        <span class="pe-7s-graph2"></span> 
                                    </div>
                                    <div class="chart" data-percent="5000">
                                        <h2 class="percent"  id="counter3">5000</h2>
                                        <h5>Uspešnih prodaja</h5>
                                    </div>
                                </div> 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="background-color: #FCFCFC; padding-bottom: 15px; margin-bottom: 60px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">                         
                        <h2>Klijenti o nama</h2> 
                    </div>
                </div>
                <div class="row clients_row" style="padding-top: 35px;">
                    <div class="item col-md-4">
                        <div class="client-text wow fadeInRight" data-wow-delay=".4s">                                
                            <p>U odabiru novog stana nismo imali nikakvih poteškoća. Sve pohvale!</p>
                            <h4><strong>Dušan Nikolić </strong><i>Diplomirani ekonomista</i></h4>
                        </div>
                        <div class="client-face wow fadeInLeft client_pic" data-wow-delay=".5s"> 
                            <img src="assets/img/client-face1.png" alt="">
                        </div>
                    </div>
                    <div class="item col-md-4">
                        <div class="client-text wow fadeInRight" data-wow-delay=".5s">                                
                            <p>Sve je proteklo bez problema i brzo i lako smo došli do svog doma.</p>
                            <h4><strong>Milosava Milovanović </strong><i>Menadžer</i></h4>
                        </div>
                        <div class="client-face wow fadeInLeft client_pic" data-wow-delay=".6s">
                            <img src="assets/img/client-face4.jpg" alt="">
                        </div>
                    </div>
                    <div class="item col-md-4">
                        <div class="client-text wow fadeInRight" data-wow-delay=".6s">                                
                            <p>Bilo je zabavno i lako tražiti stan iz snova!</p>
                            <h4><strong>Senad Bajić </strong><i>Modni bloger</i></h4>
                        </div>
                        <div class="client-face wow fadeInLeft client_pic" data-wow-delay=".7s">
                            <img src="assets/img/client-face3.jpg" alt="">
                        </div>
                    </div>                                
                </div>                               
            </div>
        </div>      

        <!--Welcome area -->
        <div class="Welcome-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 Welcome-entry  col-sm-12">
                        <div class="col-md-5 col-md-offset-2 col-sm-6 col-xs-12">
                            <div class="welcome_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                                        <!-- /.feature title -->
                                        <h2>Singi Stan </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <div  class="welcome_services wow fadeInRight" data-wow-delay="0.3s" data-wow-offset="100">
                                <div class="row">
                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-home pe-4x"></i>
                                            </div>
                                            <h3>Izaberi stan</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-users pe-4x"></i>
                                            </div>
                                            <h3>Pomoć agenta</h3>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 text-center">
                                        <i class="welcome-circle"></i>
                                    </div>

                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-notebook pe-4x"></i>
                                            </div>
                                            <h3>Instant potpisivanje ugovora</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 m-padding">
                                        <div class="welcome-estate">
                                            <div class="welcome-icon">
                                                <i class="pe-7s-like2 pe-4x"></i>
                                            </div>
                                            <h3>Uživaj u novom prostoru </h3>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        

        <!-- boy-sale area -->
        <div class="boy-sale-area">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-sm-10 col-sm-offset-1 col-md-offset-0 col-xs-12">
                        <div class="asks-first">
                            <div class="asks-first-circle">
                                <span class="fa fa-search"></span>
                            </div>
                            <div class="asks-first-info">
                                <h2>Da li tražite novu nekretninu?</h2>
                                <p> U našoj bazi podataka koja se ažurira svakog dana, sigurno možete pronaći ono što vam odgovara.</p>                                        
                            </div>
                            <div class="asks-first-arrow">
                                <a href="property_list.php"><span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-10 col-sm-offset-1 col-xs-12 col-md-offset-0">
                        <div  class="asks-first">
                            <div class="asks-first-circle">
                                <span class="fa fa-eur"></span>
                            </div>
                            <div class="asks-first-info">
                                <h2>Želite li da prodate nekretninu?</h2>
                                <p> Možete nas kontaktirati putem telefona ili mail i jedan od naših agenata će stupiti u kontakt sa vama.</p>
                            </div>
                            <div class="asks-first-arrow">
                                <a href="contact.php"><span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <p  class="asks-call">PITANJA? Pozovite nas  : <span class="strong"> +381 11 235684</span></p>
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
        <script src="assets/js/scroll_up.js"></script>
        <script src="assets/js/navbar.js" type="text/javascript"></script>
    </body>
</html>
