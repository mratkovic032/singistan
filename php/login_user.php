<?php
session_start();
    
require 'database_connection.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if ($username === 'gazda' && $password === 'gazda') {
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = "gazda";
    die (header('Location: ../ceo_contracts.php'));
} else {
    $prep = $db->prepare('SELECT kupac.korisnicko_ime, kupac.sifra FROM kupac WHERE kupac.korisnicko_ime=? AND kupac.sifra=?');
    $prep->execute([$username, $password]);
    $prep2 = $db->prepare('SELECT agent.korisnicko_ime, agent.sifra FROM agent WHERE agent.korisnicko_ime=? AND agent.sifra=?');
    $prep2->execute([$username, $password]);
    
    if ($prep->rowCount() > 0) {
        $res = $prep->fetchAll(PDO::FETCH_OBJ);
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = "kupac";
        die (header('Location: ../index.php?msg=success'));
    } else if ($prep2->rowCount(PDO::FETCH_OBJ) > 0) {
        $res2 = $prep2->fetchAll();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = "agent";
        die (header('Location: ../index.php?msg=success'));        
    } else {
        die (header('Location: ../login.php?msg=failed'));
    }
}
?>
