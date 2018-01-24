<?php
$id = $_POST['id'];
$property_type = htmlspecialchars($_POST['property_type']);
$municipalities = htmlspecialchars($_POST['municipalities']);
$address = htmlspecialchars($_POST['address']);
$prep_address = str_replace(" ", "+", $address);
$quadrature = htmlspecialchars($_POST['quadrature']);
$price = htmlspecialchars($_POST['price']);

$floor;
$heat;
$building_floors;
$accommodation;
$parking;
$structure;


switch ($property_type) {
    case 1: //kuca
        $floor = NULL;
        $heat = htmlspecialchars($_POST['heat']);        
        $building_floors = htmlspecialchars($_POST['building_floors']);        
        $structure = htmlspecialchars($_POST['structure']);        
        $parking = htmlspecialchars($_POST['parking']);
        $accommodation = htmlspecialchars($_POST['accommodation']);
        break;
    case 3: //lokal
        $floor = NULL;
        $heat = NULL;
        $building_floors = NULL;
        $structure = NULL;
        $parking = htmlspecialchars($_POST['parking']);
        $accommodation = htmlspecialchars($_POST['accommodation']);
        break;
    case 4: //garaza
        $floor = NULL;
        $heat = NULL;
        $building_floors = NULL;
        $structure = NULL;
        $parking = NULL;
        $accommodation = NULL;
        break;
    default: //stan
        $floor = htmlspecialchars($_POST['floor']);     
        $heat = htmlspecialchars($_POST['heat']);        
        $building_floors = htmlspecialchars($_POST['building_floors']);        
        $structure = htmlspecialchars($_POST['structure']);        
        $parking = htmlspecialchars($_POST['parking']);
        $accommodation = htmlspecialchars($_POST['accommodation']);
}

$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prep_address . '&key=AIzaSyAy70D14WJrMBJWZ6NemVDNnyVGsz1Vm1U');        
$output= json_decode($geocode);    
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;

require 'database_connection.php';

$prep_update_property = $db->prepare("UPDATE nekretnina SET adresa=?, latitude=?, longitude=?, povrsina=?, struktura=?, parking=?, grejanje=?, namestenost=?, sprat=?, spratnost=?, cena=? WHERE id=?;");
$prep_update_property->execute([$address, $latitude, $longitude, $quadrature, $structure, $parking, $heat, $accommodation, $floor, $building_floors, $price, $id]);

if ($prep_update_property) {
    echo "<b>Uspesno ste izmenili podatke o nekretnini!</b>";
} else {
    echo "<b>Doslo je do greske.</b>";
}