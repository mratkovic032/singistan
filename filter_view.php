<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Pregled nekretnina</title>
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
                                ?>                        
                                <li class="wow fadeInDown" data-wow-delay="0.6s" style="font-family: 'Open Sans', sans-serif;"><a class="navbar_link" href="profile.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;<?php echo $_SESSION['username']; ?></a></li>
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

        <div class="page-head" style="margin-top: 99px;"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">početna / pregled nekretnina</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="properties-area recent-property" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                     
                    <div class="col-md-3 p0 padding-top-40">
                        <div class="blog-asside-right pr0">
                            <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
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
                                                           <?php 
                                                           if (isset($_POST['submit'])) {
                                                               if (empty($_POST['price_range'])) {                                                                   
                                                                   $price_range_1 = "30000";
                                                                   $price_range_2 = "200000";
                                                               } else {
                                                                   $price_range_filter = htmlspecialchars($_POST['price_range']);
                                                                    $price_range_filter_array = explode(",", $price_range_filter);
                                                                   $price_range_1 = $price_range_filter_array[0];
                                                                   $price_range_2 = $price_range_filter_array[1];                                                                                                                                      
                                                               }                                                                                                                                                                                                                                              
                                                                echo "data-slider-value='[" . $price_range_1 . "," . $price_range_2 . "]'";                                                                       
                                                           }                                                            
                                                           ?> id="price-range" name="price_range"><br />
                                                    <b class="pull-left color">10.000€</b> 
                                                    <b class="pull-right color">500.000€</b>                                            
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="property-geo">Kvadratura (m<sup>2</sup>) :</label>
                                                    <input type="text" class="span2"  data-slider-min="0" 
                                                           data-slider-max="400" data-slider-step="5" 
                                                           <?php 
                                                           if (isset($_POST['submit'])) {
                                                               if (empty($_POST['quadrature_range'])) {                                                                   
                                                                   $quadrature_range_1 = "50";
                                                                   $quadrature_range_2 = "250";
                                                               } else {
                                                                   $quadrature_range_filter = htmlspecialchars($_POST['quadrature_range']);
                                                                    $quadrature_range_filter_array = explode(",", $quadrature_range_filter);
                                                                   $quadrature_range_1 = $quadrature_range_filter_array[0];
                                                                   $quadrature_range_2 = $quadrature_range_filter_array[1];                                                                                                                                      
                                                               }                                                                                                                                                                                                                                              
                                                                echo "data-slider-value='[" . $quadrature_range_1 . "," . $quadrature_range_2 . "]'";                                                                       
                                                           }                                                            
                                                           ?> id="property-geo" name="quadrature_range"><br />
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
                                                        if (isset($_POST['submit'])) {
                                                            $pt = $_POST['property_type'];
                                                        }
                                                        foreach ($res_property_type as $type) {
                                                            if ($pt == $type->id) {
                                                                echo "<option value='" . $type->id . "' selected>" . $type->tip . "</option>\n";
                                                            } else {                                                                    
                                                                echo "<option value='" . $type->id . "'>" . $type->tip . "</option>\n";
                                                            }
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
                                                        if (isset($_POST['submit'])) {
                                                            $mun = $_POST['municipalities'];
                                                        }
                                                        foreach ($res_municipality as $municipality) {
                                                            if ($mun == $municipality->id) {
                                                                echo "<option value='" . $municipality->id . "' selected>" . $municipality->naziv . "</option>\n";                                                                
                                                            } else {
                                                                echo "<option value='" . $municipality->id . "'>" . $municipality->naziv . "</option>\n";
                                                            }
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
                                                                <input type="checkbox" name="structure[]" value="Garsonjera"<?php 
                                                                        if (array_key_exists("structure", $_POST)) {
                                                                               $structure_filter = $_POST['structure'];
                                                                           } else {
                                                                               $structure_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($structure_filter as $s) {
                                                                               if ($s == "Garsonjera") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Garsonjera
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="structure[]" value="Jednosobna"<?php 
                                                                        if (array_key_exists("structure", $_POST)) {
                                                                               $structure_filter = $_POST['structure'];
                                                                           } else {
                                                                               $structure_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($structure_filter as $s) {
                                                                               if ($s == "Jednosobna") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Jednosobna
                                                            </label>
                                                        </div>
                                                    </div>  

                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="structure[]" value="Dvosobna"<?php 
                                                                        if (array_key_exists("structure", $_POST)) {
                                                                               $structure_filter = $_POST['structure'];
                                                                           } else {
                                                                               $structure_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($structure_filter as $s) {
                                                                               if ($s == "Dvosobna") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Dvosobna
                                                            </label>
                                                        </div>
                                                    </div>                                                     
                                                </div>
                                                <div class="col-md-6  col-xs-6">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="structure[]" value="Trosobna"<?php 
                                                                        if (array_key_exists("structure", $_POST)) {
                                                                               $structure_filter = $_POST['structure'];
                                                                           } else {
                                                                               $structure_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($structure_filter as $s) {
                                                                               if ($s == "Trosobna") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Trosobna
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="structure[]" value="Cetvorosobna"<?php 
                                                                        if (array_key_exists("structure", $_POST)) {
                                                                               $structure_filter = $_POST['structure'];
                                                                           } else {
                                                                               $structure_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($structure_filter as $s) {
                                                                               if ($s == "Cetvorosobna") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Četvorosobna
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="structure[]" value="Petosobna"<?php 
                                                                        if (array_key_exists("structure", $_POST)) {
                                                                               $structure_filter = $_POST['structure'];
                                                                           } else {
                                                                               $structure_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($structure_filter as $s) {
                                                                               if ($s == "Petosobna") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Petosobna
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
                                                                    <input type="checkbox" name="accommodation[]" value="Namestena"<?php 
                                                                        if (array_key_exists("accommodation", $_POST)) {
                                                                               $accommodation_filter = $_POST['accommodation'];
                                                                           } else {
                                                                               $accommodation_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($accommodation_filter as $a) {
                                                                               if ($a == "Namestena") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Nameštena
                                                                </label>
                                                            </div>
                                                        </div>  

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="accommodation[]" value="Nenamestena"<?php 
                                                                        if (array_key_exists("accommodation", $_POST)) {
                                                                               $accommodation_filter = $_POST['accommodation'];
                                                                           } else {
                                                                               $accommodation_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($accommodation_filter as $a) {
                                                                               if ($a == "Nenamestena") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Nenameštena
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="accommodation[]" value="Polunamestena"<?php 
                                                                        if (array_key_exists("accommodation", $_POST)) {
                                                                               $accommodation_filter = $_POST['accommodation'];
                                                                           } else {
                                                                               $accommodation_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($accommodation_filter as $a) {
                                                                               if ($a == "Polunamestena") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Polunameštena
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
                                                                <input type="checkbox" name="parking[]" value="Slobodna zona"<?php 
                                                                        if (array_key_exists("parking", $_POST)) {
                                                                               $parking_filter = $_POST['parking'];
                                                                           } else {
                                                                               $parking_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($parking_filter as $p) {
                                                                               if ($p == "Slobodna zona") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Slobodna zona
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="parking[]" value="Zona III"<?php 
                                                                        if (array_key_exists("parking", $_POST)) {
                                                                               $parking_filter = $_POST['parking'];
                                                                           } else {
                                                                               $parking_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($parking_filter as $p) {
                                                                               if ($p == "Zona III") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Zona III
                                                            </label>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="col-md-6 col-xs-6">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="parking[]" value="Zona II"<?php 
                                                                        if (array_key_exists("parking", $_POST)) {
                                                                               $parking_filter = $_POST['parking'];
                                                                           } else {
                                                                               $parking_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($parking_filter as $p) {
                                                                               if ($p == "Zona II") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Zona II
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="parking[]" value="Zona I"<?php 
                                                                        if (array_key_exists("parking", $_POST)) {
                                                                               $parking_filter = $_POST['parking'];
                                                                           } else {
                                                                               $parking_filter = array();
                                                                           }
                                                                           
                                                                           foreach ($parking_filter as $p) {
                                                                               if ($p == "Zona I") {
                                                                                   echo "checked";
                                                                               }
                                                                           }
                                                                       ?>> Zona I
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
                    </div>

                    <div class="col-md-9  pr0 padding-top-40 properties-page">
                        <div class="col-md-12 clear">                         
                            <div class="col-md-12 layout-switcher">
                                <a class="layout-list" href="javascript:void(0);"> <i class="fa fa-th-list"></i>  </a>
                                <a class="layout-grid active" href="javascript:void(0);"> <i class="fa fa-th"></i> </a>                          
                            </div><!--/ .layout-switcher-->
                        </div>

                        <div class="col-md-12 clear"> 
                            <div id="list-type" class="proerty-th">                                
                                <?php 
                                require 'php/database_connection.php';                                                                                               
                                
                                if (isset($_POST['submit'])) {    
    
                                    $property_type = htmlspecialchars($_POST['property_type']);
                                    $municipalities = htmlspecialchars($_POST['municipalities']);
                                    $price_range = htmlspecialchars($_POST['price_range']);                                   
                                    $quadrature_range = htmlspecialchars($_POST['quadrature_range']);
                                                                        
                                    $structure;
                                    if (array_key_exists("structure", $_POST)) {                                        
                                        $structure = $_POST['structure'];
                                    } else {
                                        $structure = array();
                                    }
                                    $parking;
                                    if (array_key_exists("parking", $_POST)) {                                        
                                        $parking = $_POST['parking'];
                                    } else {
                                        $parking = array();
                                    }
                                    $accommodation;
                                    if (array_key_exists("accommodation", $_POST)) {                                        
                                        $accommodation = $_POST['accommodation'];
                                    } else {
                                        $accommodation = array();
                                    }
                                    

                                    $sql = 'SELECT COUNT(nekretnina.id) AS ukupno_redova, nekretnina.*, opstina.naziv, tip_nekretnine.tip FROM
                                                    opstina INNER JOIN (nekretnina INNER JOIN tip_nekretnine ON nekretnina.id_tip_nekretnine = tip_nekretnine.id)
                                                    ON opstina.id = nekretnina.id_opstina';    
                                    $conditions = array();    

                                    if ($property_type !== "") {
                                        $conditions[] = "id_tip_nekretnine = '$property_type'";
                                    }

                                    if ($municipalities !== "") {
                                        $conditions[] = "id_opstina = '$municipalities'";
                                    }

                                    if ($price_range !== "") {
                                        $price_array = explode(",", $price_range);

                                        $conditions[] = "(cena BETWEEN '$price_array[0]' AND '$price_array[1]')";
                                    } 

                                    if ($quadrature_range !== "") {
                                        $quadrature_array = explode(",", $quadrature_range);

                                        $conditions[] = "(povrsina BETWEEN '$quadrature_array[0]' AND '$quadrature_array[1]')";
                                    }

                                    $structure_sql = "(";
                                    if (count($structure) > 0) {
                                        if (count($structure) === 1) {
                                            $conditions[] = "struktura = '$structure[0]'";
                                        } else {
                                            foreach ($structure as $s) {
                                                $structure_sql .= "struktura = '$s' OR ";
                                            }
                                            $structure_sql = substr($structure_sql, 0, -4);
                                            $structure_sql .= ")";
                                            $conditions[] = $structure_sql;
                                        }
                                    }

                                    $parking_sql = "(";
                                    if (count($parking) > 0) {
                                        if (count($parking) === 1) {
                                            $conditions[] = "parking = '$parking[0]'";
                                        } else {
                                            foreach ($parking as $p) {
                                                $parking_sql .= "parking = '$p' OR ";
                                            }
                                            $parking_sql = substr($parking_sql, 0, -4);
                                            $parking_sql .= ")";
                                            $conditions[] = $parking_sql;
                                        }
                                    }

                                    $accommodation_sql = "(";
                                    if (count($accommodation) > 0) {
                                        if (count($accommodation) === 1) {
                                            $conditions[] = "namestenost = '$accommodation[0]'";
                                        } else {
                                            foreach ($accommodation as $a) {
                                                $accommodation_sql .= "namestenost = '$a' OR ";
                                            }
                                            $accommodation_sql = substr($accommodation_sql, 0, -4);
                                            $accommodation_sql .= ")";
                                            $conditions[] = $accommodation_sql;
                                        }

                                    }


                                    $query = $sql;
                                    if (count($conditions) > 0) {
                                        $query .= " WHERE " . implode(" AND ", $conditions);
                                    }
                                    $query .= " AND nekretnina.status = 0 ORDER BY id DESC;";
                                    
                                    $prep_filter = $db->prepare($query);
                                    $prep_filter->execute();

                                    $pagination_ctrl = "";
                                    if ($prep_filter->rowCount() > 0) {
                                        $res_filter = $prep_filter->fetchAll(PDO::FETCH_OBJ);
                                        
                                        $rows = $res_filter[0]->ukupno_redova;
                                        $items_per_page = 12;
                                        $last_page = ceil($rows / $items_per_page);

                                        if ($last_page < 1) {
                                            $last_page = 1;
                                        }

                                        $page_num = 1;
                                        if (isset($_GET['pn'])) {
                                            $page_num = preg_replace('#[^0-9]#', '', $_GET['pn']);
                                        }
                                        if ($page_num < 1) {
                                            $page_num = 1;
                                        } else if ($page_num > $last_page) {
                                            $page_num = $last_page;
                                        }
                                        if ($last_page !== 1) {                                
                                            if ($page_num > 1) {
                                                $previous = $page_num - 1;
                                                $pagination_ctrl .= "<a href='" . $_SERVER['PHP_SELF'] . "?pn=" . $previous . "'>Prethodna</a>\n";
                                                for ($i = $page_num - 3; $i < $page_num; $i++) {                                        
                                                    if ($i > 0) {
                                                        $pagination_ctrl .= "<li><a href='" . $_SERVER['PHP_SELF'] . "?pn=" . $i . "'>" . $i . "</a></li>\n";
                                                    }
                                                }
                                            } else if ($page_num == 1) {
                                                $pagination_ctrl .= "<li><a href='#' class='disabled'>Prethodna</a></li>\n";                                    
                                            }
                                            $pagination_ctrl .= "<li><a href='#' class='disabled current_pagination_number'>" . $page_num . "</a></li>\n";;

                                            for ($i = $page_num + 1; $i <= $last_page; $i++) {
                                                $pagination_ctrl .= "<li><a href='" . $_SERVER['PHP_SELF'] . "?pn=" . $i . "'>" . $i . "</a></li>\n";                                        
                                                if ($i >= $page_num + 4) {
                                                    break;
                                                }
                                            }

                                            if ($page_num == $last_page) {
                                                $pagination_ctrl .= "<li><a href='#' class='disabled'>Sledeca</a></li>\n";                                    
                                            } else {
                                                $next = $page_num + 1;
                                                $pagination_ctrl .= "<li><a href='" . $_SERVER['PHP_SELF'] . "?pn=" . $next . "'>Sledeca</a></li>\n";
                                            }
                                        }                            
                                        $start_limit = ($page_num - 1) * $items_per_page;
                                        
                                        $query = substr($query, 0, -1);
                                        $query = str_replace("COUNT(nekretnina.id) AS ukupno_redova, ", "", $query);
                                        $query .= " LIMIT ?, ?;";
//                                        echo $query . "<br />";
//                                        echo $start_limit . "<br />";
//                                        echo $items_per_page . "<br />";
                                        
                                        $prep_filter_2 = $db->prepare($query);
                                        $prep_filter_2->execute([$start_limit, $items_per_page]);
                                        
                                        if ($prep_filter_2->rowCount() > 0) {
                                            $res_filter_2 = $prep_filter_2->fetchAll(PDO::FETCH_OBJ);
                                            
                                            foreach ($res_filter_2 as $property) {
                                                $prep_img = $db->prepare('SELECT putanja_slike FROM slika WHERE id_nekretnina = ? LIMIT 1;');
                                                $prep_img->execute([$property->id]);                                                

                                                $property_address = "";
                                                if (strlen($property->adresa) > 20) {
                                                    $property_address = substr($property->adresa, 0, 19) . "...";
                                                } else {
                                                    $property_address = $property->adresa;
                                                }

                                                echo "<div class='col-sm-6 col-md-4 p0'>\n";
                                                echo "<div class='box-two proerty-item'>\n";
                                                echo "<div class='item-thumb'>\n";
                                                if ($prep_img->rowCount() > 0) {
                                                    $res_img = $prep_img->fetchAll(PDO::FETCH_OBJ);
                                                    if ($res_img[0]->putanja_slike != null) {
                                                        echo "<a href='property_view.php?id=" . $property->id ."'><img src='" . $res_img[0]->putanja_slike . "' alt='Slike stana' /></a>\n";                                        
                                                    } else {
                                                        echo "<a href='property_view.php?id=" . $property->id ."'><img src='assets/img/default_image.png' alt='Slike stana' /></a>\n";
                                                    }
                                                } else {
                                                    echo "<a href='property_view.php?id=" . $property->id ."'><img src='assets/img/default_image.png' alt='Slike stana' /></a>\n";
                                                }                                                
                                                echo "</div>\n";
                                                echo "<div class='item-entry overflow'>\n";
                                                echo "<h5><a href='property_view.php?id=" . $property->id . "'>" . $property_address . "</a></h5>\n";
                                                echo "<div class='dot-hr'></div>\n";
                                                echo "<span class='pull-left'><b> Tip nekretnine: </b>" . $property->tip . "</span><br />\n";
                                                echo "<span class='pull-left'><b> Opština: </b>" . $property->naziv . "</span><br />\n";
                                                echo "<div class='list_properties' style='display: none;'>\n";
                                                echo "<span class='pull-left'><b> Površina: </b>" . $property->povrsina . "<sup>2</sup></span><br />\n";
                                                echo "<span class='pull-left'><b> Struktura: </b>" . $property->struktura . "</span><br />\n";
                                                echo "</div>\n";
                                                echo "<span class='proerty-price pull-left'>" . number_format($property->cena) . " €</span>\n";
                                                echo "</div>\n";
                                                echo "</div>\n";
                                                echo "</div>\n";
                                            }        
                                        } else {
                                            echo "<div class='content-area error-page' style='background-color: #FCFCFC; padding-bottom: 55px;'>\n";
                                            echo "<div class='text-center page-title'>\n";
                                            echo "<h2 class='error-title'>Na žalost u našoj bazi nemamo nekretnina koji odgovaraju datim kriterijumima</h2>\n";
                                            echo "<p>Mozete pogledati kompletnu ponudu <a href='property_list.php'>OVDE</a></p>\n";
                                            echo "</div>\n";
                                            echo "</div>\n";
                                        }
                                    } 
                                }
                                ?>                                    
                            </div>
                        </div>

                        <div class="col-md-12"> 
                            <div class="text-center">
                                <div class="pagination">
                                    <ul>
                                        <?php
                                        echo $pagination_ctrl;
                                        ?>
                                    </ul>
                                </div>
                            </div>                
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
    </body>
</html>