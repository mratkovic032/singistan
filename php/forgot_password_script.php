<?php

$from = 'dowsha032@gmail.com';
$to = htmlspecialchars($_POST['email']);
$subject = "Zahtevana lozinka";

require 'database_connection.php';
$prep_pass = $db->prepare("SELECT agent.email, agent.ime, agent.prezime, agent.sifra, agent.korisnicko_ime FROM agent WHERE email = ? "
        . "UNION "
        . "SELECT kupac.email, kupac.ime, kupac.prezime, kupac.sifra, kupac.korisnicko_ime FROM kupac WHERE email = ?");
$prep_pass->execute([$to, $to]);

if ($prep_pass->rowCount() > 0) {
    $res_user = $prep_pass->fetchAll(PDO::FETCH_OBJ);
    $message = "Korisnicko ime: " . $res_user[0]->korisnicko_ime . "\r\n" . "Šifra: " . $res_user[0]->sifra;
//    echo $message . "<br />";
//    echo $to . "<br />";
//    echo $res_user[0]->ime . "<br />";
    mail($to, $subject, "Ime i prezime: " . $res_user[0]->ime . " " . $res_user[0]->prezime . "\r\n" . "E-mail: " . $to . "\r\n" . $message, "From: " . $from);    
    die (header('Location: ../login.php?msg=pass_email_sent'));
} else {
    die (header('Location: ../forgot_password.php?msg=invalid_user'));
}
?>
