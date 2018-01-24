<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Pregled nekretnine</title>
        <meta name="description" content="GARO is a real-estate template">        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
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
        <link rel="stylesheet" href="assets/css/lightslider.min.css">
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
                        <?php
                        if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && ($_SESSION['user_type'] === "kupac"))) {
                            ?>
                            <li class="wow fadeInDown" data-wow-delay="0.5s"><a class="navbar_link" href="contact.php">Kontakt</a></li>
                            <?php
                        }
                        if (isset($_SESSION['username'])) {
                            if ($_SESSION['user_type'] === "kupac") {
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
                                            <a class="navbar_link" href="agent_contract.php">Novi ugovor</a>
                                        </li>
                                    </ul>
                                </li>
                            <li class="wow fadeInDown" data-wow-delay="0.7s"><a class="navbar_link" href="agent_profile.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['username']; ?></a></li>  
                            <?php
                        }
                    }
                    ?>                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
	<?php 
        require 'php/database_connection.php';
        
        if (isset($_GET['id'])) {
            $prep = $db->prepare("SELECT nekretnina.* FROM nekretnina WHERE nekretnina.id = ?");
            $prep->execute([$_GET['id']]);
            
            $res = $prep->fetchAll(PDO::FETCH_OBJ);
        }
        ?>
        <script>
            function initMap() { 
                
                var myCenter = new google.maps.LatLng(<?php echo $res[0]->latitude ?>, <?php echo $res[0]->longitude ?>);
                var mapProp = {
                    center: myCenter,
                    zoom: 16,
                    scrollwheel: false,
                    draggable: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP        
                };

                var map = new google.maps.Map(document.getElementById('googleMap'), mapProp);
                var marker = new google.maps.Marker({
                    position: myCenter,
                    map: map
                });


                google.maps.event.addDomListener(window, "resize", function () {
                    var center = map.getCenter();
                    google.maps.event.trigger(map, "resize");
                    map.setCenter(center);
                });
            }
        </script>
        <div class="page-head" style="margin-top: 99px;"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">početna / pregled nekretnina / <span class="orange strong"><?php echo $res[0]->adresa ?></span></h1>               
                    </div>
                </div>
            </div>
        </div>

        

        <div class="content-area single-property" style="background-color: #FCFCFC;">
            <div class="container">
                <div class="clearfix padding-top-40">
                    <?php
                    if (isset($_GET["msg"]) && $_GET["msg"] == 'succesfully_added_to_favourites') {                             
                        echo "<div id='successful_alert' class='alert alert-success' role='alert'>\n";
                        echo "<span class='success'>Uspesno ste dodali nekretninu u listu zelja!</span><br />\n";
                        echo "</div>\n";
                    }
                    ?>                                                           
                    <?php
                    if (isset($_GET["msg"]) && $_GET["msg"] == 'already_in_favourites') {                             
                        echo "<div id='info_alert' class='alert alert-info' role='alert'>\n";
                        echo "<span class='success'>Ova nekretnina je već u vašoj listi želja!</span><br />\n";
                        echo "</div>\n";
                    }
                    ?>                                                           
                      
                    
<!--                    <button class="btn btn-default" style="margin-left: 10px; position: fixed;">ZAKAZI GLEDANJE</button>                   -->
                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right">
                            <div class="dealer-widget">
                                <div class="dealer-content">
                                    <div class="inner-wrapper">

                                        <div class="clear">
                                            <div class="col-xs-12 dealer-face">
                                               
                                                <img src="assets/img/logo.png" class="img-responsive" style="margin: auto; pointer-events: none;">
                                                
                                            </div>
                                            <div class="col-xs-12 col-sm-12 text-center ">
                                                <h3 class="dealer-name">
                                                    <a href="" style="pointer-events: none;">Singi Stan</a><br />
                                                    <span>Brzo i jednostavno!</span>        
                                                </h3>                                                
                                            </div>
                                        </div>

                                        <div class="clear">
                                            <ul class="dealer-contacts">                                       
                                                <li><i class="pe-7s-map-marker strong"> </i> 11000 Beograd, Danijelova 32</li>
                                                <li><i class="pe-7s-mail strong"> </i> office@singistan.tk</li>
                                                <li><i class="pe-7s-call strong"> </i> +381 11 235684</li>
                                            </ul>
                                            <p>Garantovano vas dovodimo do željenog doma, u rekordnom vremenu.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                                                        
                            <div class="panel panel-default sidebar-menu wow fadeInRight animated" >                                
                                <div class="panel-body search-widget">
                                    <div class="panel-heading">
                                    <h3 class="panel-title">Filter</h3>
                                </div>
                                <div class="panel-body search-widget">
                                    <form action="filter_view.php" method="POST" class=" form-inline">                                     
                                        <fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <label for="price-range">Cena od - do (EUR) :</label>
                                                    <input type="text" class="span2" data-slider-min="10000" 
                                                           data-slider-max="500000" data-slider-step="10000" 
                                                           data-slider-value="[30000,200000]" id="price-range" name="price_range"><br />
                                                    <b class="pull-left color">10.000€</b> 
                                                    <b class="pull-right color">500.000€</b>                                            
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="property-geo">Kvadratura (m<sup>2</sup>) :</label>
                                                    <input type="text" class="span2"  data-slider-min="0" 
                                                           data-slider-max="600" data-slider-step="5" 
                                                           data-slider-value="[50,250]" id="property-geo" name="quadrature_range"><br />
                                                    <b class="pull-left color">0m<sup>2</sup></b> 
                                                    <b class="pull-right color">600m<sup>2</sup></b>                                            
                                                </div>                                            
                                            </div>
                                        </fieldset>  
                                        <hr />
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-xs-12">
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
                                                <br /><br />
                                                <div class="col-xs-12">
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
                                            </div>
                                        </fieldset>
                                        <hr />
                                        <fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6">
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
                                                </div>
                                                <div class="col-md-6  col-xs-6">
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
                                            </div>
                                        </fieldset>
                                        <hr />
                                        <fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6">
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
                                        </fieldset>
                                        <hr />
                                        <fieldset class="padding-5">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6">
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
                                                </div>
                                                <div class="col-md-6 col-xs-6">
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
                                            </div>
                                        </fieldset>
                                        <hr />
                                        <button class="btn search-btn" type="submit" name="submit" style="display: block; width: 100%;">Pretraži <i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                </div>
                            </div>


                        </aside>
                    </div>

<div class="col-md-8 single-property-content ">
                        <div class="row">
                            <div class="light-slide-item">            
                                <div class="clearfix">
                                    <div class="favorite-and-print">
                                        <?php 
                                        if (isset($_SESSION['username']) && $_SESSION['user_type'] == "kupac") {
                                            $prep_user = $db->prepare("SELECT * FROM kupac WHERE korisnicko_ime = ?;");
                                            $prep_user->execute([$_SESSION['username']]);
                                            $res_user = $prep_user->fetchAll(PDO::FETCH_OBJ);
                                            
                                            echo "<a class='add-to-fav' href='#login-moda' data-toggle='modal'>\n";
                                            echo "<i class='fa fa-star' data-toggle='tooltip' data-placement='bottom' title='Dodaj u listu zelja' onclick='window.open(\"php/add_favourite.php?user_id={$res_user[0]->id}&property_id={$res[0]->id}\", \"_self\");'></i>\n";
                                            echo "</a>\n";
                                        }
                                        ?>                                      
                                        <a class="printer-icon " href="javascript:window.print()">
                                            <i class="fa fa-print" data-toggle="tooltip" data-placement="bottom" title="Štampaj"></i> 
                                        </a>
                                    </div> 

                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                        <?php 
                                        $prep_picture = $db->prepare("SELECT slika.putanja_slike FROM slika WHERE id_nekretnina = ?;");
                                        $prep_picture->execute([$res[0]->id]);
                                        if ($prep_picture->rowCount() > 0) {
                                            $res_picture = $prep_picture->fetchAll(PDO::FETCH_OBJ);                                            
                                            foreach ($res_picture as $pic) {
                                                if ($pic->putanja_slike != null) {
                                                    echo "<li data-thumb='" . $pic->putanja_slike . "' >\n";
                                                    echo "<img src='" . $pic->putanja_slike . "' alt='Slike stana'  />";
                                                    echo "</li>\n";
                                                } else {
                                                    echo "<li data-thumb='assets/img/default_image.png' >\n";
                                                    echo "<img src='assets/img/default_image.png' alt='Slike stana'  />";
                                                    echo "</li>\n";
                                                }
                                            }
                                        } else {
                                            echo "<li data-thumb='assets/img/default_image.png' >\n";
                                            echo "<img src='assets/img/default_image.png' alt='Slike stana'  />";
                                            echo "</li>\n";
                                        }
                                        ?>                                                                                                                       
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-property-wrapper">
                            <div class="single-property-header">                                          
                                <?php 
                                $prep_2 = $db->prepare("SELECT nekretnina.*, opstina.naziv, tip_nekretnine.tip FROM
                                                    opstina INNER JOIN (nekretnina INNER JOIN tip_nekretnine ON nekretnina.id_tip_nekretnine = tip_nekretnine.id)
                                                    ON opstina.id = nekretnina.id_opstina WHERE nekretnina.id = ?;");
                                $prep_2->execute([$_GET['id']]);
                                $res_2 = $prep_2->fetchAll(PDO::FETCH_OBJ);                                
                                ?>
                                <h1 class="property-title pull-left"><?php echo $res[0]->adresa . ", " . $res_2[0]->tip; ?></h1>
                                <span class="property-price pull-right"><?php echo number_format($res[0]->cena); ?> €</span>                                
                            </div>
                            <?php 
                            if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && ($_SESSION['user_type'] === "kupac"))) {
                                echo "<button class='btn btn-default pull-right' data-toggle='modal' data-target='#contract_modal'>ZAKAZI GLEDANJE</button>";
                            }                            
                            ?>                            
                            <div class="section additional-details">

                                <h4 class="s-property-title">Additional Details</h4>

                                <ul class="additional-details-list clearfix">
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Opština</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry"><?php echo $res_2[0]->naziv ?></span>
                                    </li>
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Adresa</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry"><?php echo $res[0]->adresa ?></span>
                                    </li>
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Struktura</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">
                                            <?php 
                                            if ($res[0]->struktura == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->struktura;                                                
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Površina</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">
                                            <?php
                                            if ($res[0]->povrsina == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->povrsina; 
                                            }
                                            ?> 
                                        m<sup>2</sup></span>
                                    </li>
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Nameštenost</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">
                                            <?php
                                            if ($res[0]->namestenost == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->namestenost; 
                                            }
                                            ?>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Parking</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">
                                            <?php
                                            if ($res[0]->parking == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->parking; 
                                            }
                                            ?>                                            
                                        </span>
                                    </li> 
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Vrsta grejanja</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">
                                            <?php
                                            if ($res[0]->grejanje == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->grejanje; 
                                            }
                                            ?>
                                        </span>
                                    </li> 
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Sprat</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">
                                            <?php
                                            if ($res[0]->sprat == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->sprat; 
                                            }
                                            ?>                                            
                                        </span>
                                    </li> 
                                    <li>
                                        <span class="col-xs-6 col-sm-4 col-md-4 add-d-title">Ukupno spratova</span>
                                        <span class="col-xs-6 col-sm-8 col-md-8 add-d-entry">                                            
                                            <?php
                                            if ($res[0]->spratnost == NULL) {
                                                echo "/";
                                            } else {
                                                echo $res[0]->spratnost; 
                                            }
                                            ?>  
                                        </span>
                                    </li> 

                                </ul>
                            </div>                          
                            
                            <div class="section">
                                <h4 class="s-property-title">Lokacija</h4>
                                <!-- Google Map -->
                                <div id="googleMap"></div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy70D14WJrMBJWZ6NemVDNnyVGsz1Vm1U&callback=initMap"></script>
                            </div>
                            <?php
                            if (!isset($_SESSION['username']) || (isset($_SESSION['username']) && ($_SESSION['user_type'] === "kupac"))) {
                                echo "<button class='btn btn-default pull-right' data-toggle='modal' data-target='#contract_modal'>ZAKAZI GLEDANJE</button>";
                            } 
                            if (isset($_SESSION['username']) && $_SESSION['user_type'] === "agent") {
                                echo "<button class='btn btn-default pull-right' data-toggle='modal' data-target='#update_property_modal' onclick='check_property_type()'>IZMENI</button>";
                                echo "<button class='btn btn-default pull-right' id='delete_button' onclick='if(confirm(\"Da li ste sigurni da želite da obrišete nekretninu?\")){window.open(\"php/delete_property.php?id={$res[0]->id}\", \"_self\")};''>IZBRISI</button>";
                            }
                            ?>
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
        
        
        <!-- modal -->
        <div class="modal fade" id="contract_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: 1px solid #e5e5e5">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="appointment_modal_title" class="modal-title text-center" style="color: orange;">Zakazi gledanje</h4>                        
                    </div>
                    <div class="modal-body" id="appointment_modal_body">
                        <form action="php/new_appointment.php" method="POST" id='make_appointment_form'>
                            <input type='hidden' name='property_id' <?php echo "value='" . $res_2[0]->id . "'"; ?> />
                            <input type='hidden' name='user_id' <?php echo "value='" . $res_user[0]->id . "'"; ?> />
                                <div class="row">
                                    <div class="card text-center col-md-5" style="margin-bottom: 15px;">
                                        <?php 
                                        $prep_pic = $db->prepare("SELECT kupac.putanja_slike FROM kupac WHERE korisnicko_ime = ?;");
                                        $prep_pic->execute([$_SESSION['username']]);
                                        if ($prep_pic->rowCount() > 0) {
                                            $res_pic = $prep_pic->fetchAll(PDO::FETCH_OBJ);
                                            if ($res_pic[0]->putanja_slike != null) {
                                                echo "<img class='card-img-top' src='" . $res_pic[0]->putanja_slike . "' alt='Card image cap' style='width: 200px; height: 200px;'>";                                                
                                            } else {
                                                echo "<img class='card-img-top' src='assests/img/profile_blank.jpg' alt='Card image cap' style='width: 200px; height: 200px;'>";
                                            }
                                        } else {
                                            echo "<img class='card-img-top' src='assests/img/profile_blank.jpg' alt='Card image cap' style='width: 200px; height: 200px;'>";
                                        }                                                                                     
                                        ?>                                        
                                        <div class="card-body">
                                            <p class="card-text"><b><?php echo $res_user[0]->ime . " " . $res_user[0]->prezime ?></b></p>
                                            <p class="card-text"><b><?php echo $res_user[0]->email ?></b></p>
                                            <p class="card-text"><b><?php echo $res_user[0]->telefon ?></b></p>
                                        </div>
                                    </div>
                                    <div class="request pull-right col-md-7">
                                        <p style="padding: 0 15px 10px 15px;">Zelim da zakazem termin gledanja sledece nekretnine:<br /> <b><?php echo $res_2[0]->adresa . ", " . $res_2[0]->naziv ?></b></p>
                                        <div class='col-sm-12'>
                                            <div class="form-group">                                    
                                                <input type='datetime-local' name='date' class="form-control" id="modal_date" required/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="clear: both;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Nazad</button>
                        <button type="submit" name="submit" id="modal_submit_date_button" class="btn btn-default">Zakaži <span class="glyphicon glyphicon-home" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="update_property_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: 1px solid #e5e5e5">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="update_modal_title" class="modal-title text-center" style="color: orange;">Izmeni nekretninu</h4>                        
                    </div>
                    <div class="modal-body" id="update_modal_body">
                        <div class="col-md-12 col-xs-12 register-blocks">

                            <form action="php/update_property.php" method="POST" id="update_property_form">
                                <input type="hidden" name="id" <?php echo "value='" . $res[0]->id . "'"; ?> />
                                <div class="col-md-12" id="new_property_form">                                    
                                    <div class="form-group">
                                        <label for="property_type">Tip nekretnine</label>
                                        <br>
                                        <select class="form-control" id="property_type" name="property_type">
                                            <option>- - -</option>
                                            <?php
                                            require 'php/database_connection.php';
                                            $prep_select_property_type = $db->prepare('SELECT * FROM tip_nekretnine;');
                                            $prep_select_property_type->execute();
                                            $res_select_property_type = $prep_select_property_type->fetchAll(PDO::FETCH_OBJ);
                                            
                                            $prep_selected_property_type = $db->prepare('SELECT nekretnina.id_tip_nekretnine FROM nekretnina WHERE nekretnina.id = ?');
                                            $prep_selected_property_type->execute([$res[0]->id]);
                                            $res_selected_property_type = $prep_selected_property_type->fetchAll(PDO::FETCH_OBJ);
                                            
                                            foreach ($res_select_property_type as $r) {
                                                if ($r->id == $res_selected_property_type[0]->id_tip_nekretnine) {
                                                    echo "<option id='selected_property_type' value='" . $r->id . "' selected>" . $r->tip . "</option>\n";
                                                }
                                                echo "<option value='" . $r->id . "'>" . $r->tip . "</option>\n";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="opstina">Opština</label>
                                        <br>

                                        <select class="form-control" id="opstina" name="municipalities" required>
                                            <option>- - -</option>
                                            <?php
                                            require 'php/database_connection.php';
                                            $prep_municipality = $db->prepare('SELECT * FROM opstina ORDER BY naziv ASC;');
                                            $prep_municipality->execute();
                                            $res_municipality = $prep_municipality->fetchAll(PDO::FETCH_OBJ);
                                            
                                            $prep_selected_municipalities = $db->prepare('SELECT nekretnina.id_opstina FROM nekretnina WHERE nekretnina.id = ?;');
                                            $prep_selected_municipalities->execute([$res[0]->id]);
                                            $res_selected_municipalities = $prep_selected_municipalities->fetchAll(PDO::FETCH_OBJ);
                                            
                                            foreach ($res_municipality as $municipality) {
                                                if ($municipality->id == $res_selected_municipalities[0]->id_opstina) {
                                                    echo "<option value='" . $municipality->id . "' selected>" . $municipality->naziv . "</option>\n";                                                                
                                                } else {
                                                    echo "<option value='" . $municipality->id . "'>" . $municipality->naziv . "</option>\n";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="adresa">Adresa</label>                                        
                                        <input type="text" class="form-control" id="adresa" name="address" <?php echo "value='" . $res[0]->adresa . "'"; ?> required>
                                    </div>
                                    <div class="form-group" id="structure">
                                        <label for="struktura">Struktura</label>
                                        <br>
                                        <select class="form-control" name="structure">
                                            <option>- - -</option>
                                            <option value="Garsonjera" <?php 
                                            if ($res[0]->struktura != null && $res[0]->struktura == "Garsonjera") {
                                                echo "selected";
                                            }
                                            ?>>Garsonjera</option>
                                            <option value="Jednosobna" <?php 
                                            if ($res[0]->struktura != null && $res[0]->struktura == "Jednosobna") {
                                                echo "selected";
                                            }
                                            ?>>Jednosobna</option>
                                            <option value="Dvosobna" <?php 
                                            if ($res[0]->struktura != null && $res[0]->struktura == "Dvosobna") {
                                                echo "selected";
                                            }
                                            ?>>Dvosobna</option>
                                            <option value="Trosobna" <?php 
                                            if ($res[0]->struktura != null && $res[0]->struktura == "Trosobna") {
                                                echo "selected";
                                            }
                                            ?>>Trosobna</option>
                                            <option value="Cetvorosobna" <?php 
                                            if ($res[0]->struktura != null && $res[0]->struktura == "Cetvorosobna") {
                                                echo "selected";
                                            }
                                            ?>>Cetvorosobna</option>
                                            <option value="Petosobna" <?php 
                                            if ($res[0]->struktura != null && $res[0]->struktura == "Petosobna") {
                                                echo "selected";
                                            }
                                            ?>>Petosobna</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="parking">
                                        <label for="struktura">Parking</label>
                                        <br>
                                        <select class="form-control" name="parking">
                                            <option>- - -</option>
                                            <option value="Slobodna zona" <?php 
                                            if ($res[0]->parking != null && $res[0]->parking == "Slobodna zona") {
                                                echo "selected";
                                            }
                                            ?>>Slobodna zona</option>
                                            <option value="Zona III" <?php 
                                            if ($res[0]->parking != null && $res[0]->parking == "Zona III") {
                                                echo "selected";
                                            }
                                            ?>>Zona III</option>
                                            <option value="Zona II" <?php 
                                            if ($res[0]->parking != null && $res[0]->parking == "Zona II") {
                                                echo "selected";
                                            }
                                            ?>>Zona II</option>
                                            <option value="Zona I" <?php 
                                            if ($res[0]->parking != null && $res[0]->parking == "Zona I") {
                                                echo "selected";
                                            }
                                            ?>>Zona I</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="m2">Površina</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="m2" name="quadrature" <?php echo "value='" . $res[0]->povrsina . "'"; ?> required>
                                            <span class="input-group-addon" style="border-radius: 0;">m<sup>2</sup></span>                                        
                                        </div>
                                    </div>
                                    <div class="form-group" id="accommodation">
                                        <label for="struktura">Nameštenost</label>
                                        <br />
                                        <select class="form-control" name="accommodation">
                                            <option>- - -</option>
                                            <option value="Namestena" <?php 
                                            if ($res[0]->namestenost != null && $res[0]->namestenost == "Namestena") {
                                                echo "selected";
                                            }
                                            ?>>Nameštena</option>
                                            <option value="Polunamestena" <?php 
                                            if ($res[0]->namestenost != null && $res[0]->namestenost == "Polunamestena") {
                                                echo "selected";
                                            }
                                            ?>>Polunameštena</option>
                                            <option value="Nenamestena" <?php 
                                            if ($res[0]->namestenost != null && $res[0]->namestenost == "Nenamestena") {
                                                echo "selected";
                                            }
                                            ?>>Nenameštena</option>                                                
                                        </select>
                                    </div>                                                                                
                                    <div class="form-group" id="heat">
                                        <label for="grejanje">Vrsta grejanja</label>
                                        <input type="text" class="form-control" name="heat" <?php 
                                            if ($res[0]->grejanje != null) {
                                                echo "value='" . $res[0]->grejanje . "'";
                                            }
                                            ?>>
                                    </div>
                                    <div class="form-group" id="floor">
                                        <label for="sprat">Sprat</label>
                                        <input type="number" class="form-control" name="floor" <?php 
                                            if ($res[0]->sprat != null) {
                                                echo "value='" . $res[0]->sprat . "'";
                                            }
                                            ?>>
                                    </div>
                                    <div class="form-group" id="building_floors" >
                                        <label for="spratnost">Ukupno spratova</label>
                                        <input type="number" class="form-control" name="building_floors" <?php 
                                            if ($res[0]->spratnost != null) {
                                                echo "value='" . $res[0]->spratnost . "'";
                                            }
                                            ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="cena">Cena</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="cena" name="price" <?php echo "value='" .  $res[0]->cena . "'"; ?> required>
                                            <span class="input-group-addon" style="border-radius: 0;">€</span>                                        
                                        </div>
                                    </div>                                    
                                    
                                </div>                                
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Nazad</button>
                        <button type="submit" name="submit" id="modal_submit_button" class="btn btn-default">Izmeni <span class="glyphicon glyphicon-home" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="assets/js/vendor/modernizr-2.6.2.min.js"></script>
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
        <script type="text/javascript" src="assets/js/lightslider.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/navbar.js" type="text/javascript"></script>        
        <script src="assets/js/update_property_modal.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#successful_alert').delay(3000).slideUp();               
                $('#info_alert').delay(3000).slideUp();                
                $('#image-gallery').lightSlider({
                    gallery: true,
                    item: 1,
                    thumbItem: 9,
                    slideMargin: 0,
                    speed: 500,
                    auto: true,
                    loop: true,
                    onSliderLoad: function () {
                        $('#image-gallery').removeClass('cS-hidden');
                    }
                });
                
                $('#update_property_form').on("submit", function() {
                    var post_data = $(this).serializeArray();
                    var form_url = $(this).attr("action");
                    
                    $.ajax({
                        url: form_url,
                        type: "POST",
                        data: post_data,
                        success: function(data, textStatus, jqXHR) {
                            $('#update_modal_title').html("Rezultat");
                            $('#update_modal_body').html(data);
                            $('#modal_submit_button').remove();
                        },
                        error: function(jqXHR, status, error) {
                            console.log(status + ": " + error);
                        }
                    });
                    e.preventDefault();
                });
                
                $('#modal_submit_button').on("click", function() {                    
                    $('#update_property_form').submit();
                });
                
                $('#make_appointment_form').on("submit", function() {
                    var post_data = $(this).serializeArray();
                    var form_url = $(this).attr("action");
                    
                    $.ajax({
                        url: form_url,
                        type: "POST",
                        data: post_data,
                        success: function(data, textStatus, jqXHR) {
                            $('#appointment_modal_title').html("Rezultat");
                            $('#appointment_modal_body').html(data);
                            $('#modal_submit_date_button').remove();
                        },
                        error: function(jqXHR, status, error) {
                            console.log(status + ": " + error);
                        }
                    });
                    e.preventDefault();
                });
                
                
                $('#modal_submit_date_button').on("click", function() {                    
                    $('#make_appointment_form').submit();
                });
            });
        </script>
        
    </body>
</html>