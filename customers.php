<?php
session_start();

// If no session variable exists, or unauthorized user_level, redirect the user:
if (isset($_SESSION['username'])) {
    // if a valid user session is found then the user level is checked, if the
    // user has level 3 access they will be granted access if not a access denied
    //message be displayed and the user will be redirected.
    if ($_SESSION['user_type'] == "agent") {
        
    } else {
        header("Refresh: 3; url=index.php");
        include '404_customers.php';

        exit(); // Quit the script.
    }
}
// if no valid session is found then the user is not logged in and will
// receive a access denied message and will be redirected to the login page.
else if (!isset($_SESSION['user_id'])) {

    header("Refresh: 3; url=login.php");
    include_once '404.php';

    exit(); // Quit the script.
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Singi Stan | Lista kupaca</title>
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

        <!-- end of navbar-->
        <div class="page-head" style="margin-top: 99px;"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Početna / Agent / lista kupaca</h1>               
                    </div>
                </div>
            </div>
        </div>

        <!--content-->
        <div class="content-area user-profiel" style="background-color: #fff;">&nbsp;
            <div class="container">
                <div class="row">
                    <div class="col-md-2">

                        <label><span class="glyphicon glyphicon-search"></span><small> &nbsp;Pretraži kupca</small></label>

                        <input type="text" class="form-control" id='pretrazi_kupca' onkeyup="myFunction()"/>

                    </div>
                        <?php
                    if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
                                echo "<div class='col-md-10'> \n";
                                echo "<div class='alert alert-success' role='alert'>\n";
                                echo "<span class='success'>Uspesno ste se obrisali kupca!<br />\n";
                                echo "</div>\n";
                                echo "</div>\n";
                            }
                            ?> 

                </div>
            </div>


            <div class="container_tabela">

                <div class="table-responsive">
                    <table class="table table-hover" id="tabela_kupci">
                        <thead>
                            <tr>
                                <th>r.b.</th>
                                <th>Ime i prezime</th>
                                <th>JMBG</th>
                                <th>Adresa</th>
                                <th>Telefon</th>
                                <th>Korisničko ime</th>
                                <th>E-mail</th>
                                <th>Izbrisati</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                            require 'php/database_connection.php';
                                            $prep = $db->prepare('SELECT * FROM kupac;');
                                            $prep->execute();
                                            $res = $prep->fetchAll(PDO::FETCH_OBJ);
                                            $br=1;
                            foreach ($res as $r) {   
                            
                            echo "<tr> \n";
                            echo "<td class='por'>".($br)."</td> \n";
                            if ($r->putanja_slike != null) {
                                echo "<td><a data-toggle='modal' href='#pic' ><img src='" . $r->putanja_slike . "' class='img_prifile_xs'></a>&nbsp;&nbsp;".$r->ime."&nbsp;".$r->prezime."</td> \n";
                            } else {
                                echo "<td><a data-toggle='modal' href='#pic' ><img src='assets/img/profile_blank.jpg' class='img_prifile_xs'></a>&nbsp;&nbsp;".$r->ime."&nbsp;".$r->prezime."</td> \n";                                
                            }
                            echo "<td class='por'>".$r->jmbg."</td> \n";
                            echo "<td class='por'>".$r->adresa."</td> \n";
                            echo "<td class='por'>".$r->telefon."</td> \n";
                            echo "<td class='por'>".$r->korisnicko_ime."</td> \n";
                            echo "<td class='por'>".$r->email."</td> \n";
                            echo "<td class='por'><button class='btn btn-danger btn-xs' style='border-width: 1px;' onclick='if(confirm(\"Da li ste sigurni da želite da obrišete kupca?\")){window.open(\"php/delete_customer.php?ID={$r->id}\", \"_self\")};' ><span class='glyphicon glyphicon-trash'></span></button></td> \n";
                            echo "</tr> \n";
                            $br=$br+1;
                            }           
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end of content-->
        <!--modal-->

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Neuspešno brisanje korisnika</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> &nbsp;Kupac se ne može obrisati jer je sa njim sastavljen ugovor ili je zakazao gledanje nekretnine!</div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> U redu</button>
                    </div>
                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>

        <div class="modal fade" id="pic" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Slika korisnika</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center"><?php
                        
                        if ($r->putanja_slike != null) {
                                echo "<img src='{$r->putanja_slike}'alt='profilna' class='img_profile_lg'/> \n";
                            } else {
                                echo "<img src='assets/img/profile_blank.jpg' alt='profilna' class='img_profile_lg'/> \n";
                            }
                        ?>
                            
                        </div>
                    </div>

                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
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
            function myFunction() {
                var input, filter, table, tr, td, i;
                input = document.getElementById("pretrazi_kupca");
                filter = input.value.toUpperCase();
                table = document.getElementById("tabela_kupci");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
        <script>
            $(document).ready(function() {
                $('.alert-success').delay(3000).slideUp();
            });
        </script>
        <?php
        if (isset($_GET["msg"]) && $_GET["msg"] == 'delete_restrict') {
        echo "<script>";
        echo "    $('#delete').modal('show');";
        echo "</script>";
        }
        ?>
        

    </body>
</html>    
