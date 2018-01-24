<?php
require 'database_connection.php';
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
$date = $_POST['date'];

$prep = $db->prepare("INSERT INTO gledanje_nekretnine (vreme, id_kupac, id_nekretnina) VALUES (?, ?, ?);");
$prep->execute([$date, $user_id, $property_id]);

if ($prep) {
    $prep_notification = $db->prepare("UPDATE agent SET notifikacija = notifikacija + 1;");
    $prep_notification->execute();
    echo "<b>Uspesno ste zakazali termin za datum: <span style='color: orange;'>" . $date . "</span>.</b><br />\n";
    echo "<b>Bicete naknadno kontaktirani putem telefona.</b><br />\n";
    echo "<b>Hvala na poverenju!</b>\n";
}
