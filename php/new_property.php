<?php

if (isset($_POST['submit'])) {
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
    $prep = $db->prepare('SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?;');
    $prep->execute([$database_name, 'nekretnina']);
    $res = $prep->fetchAll(PDO::FETCH_OBJ);
    echo $res[0]->AUTO_INCREMENT;
    $curdir = getcwd();
    mkdir($curdir . "/../assets/img/property_images/" . $res[0]->AUTO_INCREMENT, 0777);   
    
    for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
        $file_tmp = $_FILES["file"]["tmp_name"][$i];
        $file_name = $_FILES["file"]["name"][$i];
        $file_type = $_FILES["file"]["type"][$i];
        $file_path = "assets/img/property_images/" . $res[0]->AUTO_INCREMENT . "/" . $file_name;
        
        $exploded_file_name = explode(".", $file_name);
        $file_ext = end($exploded_file_name);

        if (!preg_match("/\.(gif|jpg|png)$/i", $file_name)) {
            die (header('Location: ../agent_new_property.php?msg=not_pic'));
            break 2;
        }
        
        move_uploaded_file($file_tmp, "../assets/img/property_images/" . $res[0]->AUTO_INCREMENT . "/" . $file_name);            
                                
        $prep3 = $db->prepare('INSERT INTO slika (id_nekretnina, ime_slike, putanja_slike, tip_slike) VALUES (?, ?, ?, ?);');
        $prep3->execute([$res[0]->AUTO_INCREMENT, $file_name, $file_path, $file_type]);        
    }
    
    $prep2 = $db->prepare('INSERT INTO nekretnina (adresa, latitude, longitude, povrsina, struktura, parking, grejanje, namestenost, sprat, spratnost, cena, status, id_opstina, id_tip_nekretnine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $prep2->execute([$address, $latitude, $longitude, $quadrature, $structure, $parking, $heat, $accommodation, $floor, $building_floors, $price, 0, $municipalities, $property_type]);

    die (header('Location: ../agent_new_property.php?msg=property_has_been_successfully_added'));
}
?>

