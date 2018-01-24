<?php
session_start();
$to = 'dowsha032@gmail.com';
if (!isset($_SESSION['username'])) {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $subject = htmlspecialchars($_POST['subject']);
    $from = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

//    $content = "  
//    <html>
//        <head>
//            <title>HTML email</title>
//        </head>
//        <body>
//            <h3>" . $name . " " . $surname . "</h3>
//            <p>" . $message . "</p>    
//        </body>
//    </html>
//    ";
//    $headers = "MIME-Version: 1.0" . "\r\n";
//    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    mail($to, $subject, "Ime i prezime: " . $name . " " . $surname . "\r\n" . "E-mail: " . $from . "\r\n" . $message, "From: " . $from);
    
    die (header('Location: ../contact.php?msg=email_has_been_sent'));
    
} else {
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    require 'database_connection.php';
    
    $prep = $db->prepare('SELECT ime, prezime, email FROM kupac WHERE korisnicko_ime=?;');
    $prep->execute([$_SESSION['username']]);
    
    $res = $prep->fetchAll(PDO::FETCH_OBJ);   
//    print_r($res);
    
    mail($to, $subject, "Ime i prezime: " . $res[0]->ime . " " . $res[0]->prezime . "\r\n" . "E-mail: " . $res[0]->email . "\r\n" .  $message, "From: " . $res[0]->email);
    
    die (header('Location: ../contact.php?msg=email_has_been_sent'));
}

?>
