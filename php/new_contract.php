<?php
session_start();
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
$date = $_POST['date'];

if ($_FILES['file']['name'] != "") {
    
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_path = "assets/contracts/" . $file_name;

    $exploded_file_name = explode(".", $file_name);
    $file_ext = end($exploded_file_name);
    
    if ($file_ext != "pdf") {
        die (header('Location: ../agent_contract.php?msg=not_pdf'));
        exit();        
    } else {
        move_uploaded_file($file_tmp, "../assets/contracts/" . $file_name);        
    }
    
    require 'database_connection.php';
    $prep_agent = $db->prepare("SELECT agent.id FROM agent WHERE korisnicko_ime = ?;");
    $prep_agent->execute([$_SESSION['username']]);
    $res_agent = $prep_agent->fetchAll(PDO::FETCH_OBJ);
    
    $prep_contract = $db->prepare("INSERT INTO ugovor (datum, putanja_ugovora, id_agent, id_kupac, id_nekretnina) VALUES (?, ?, ?, ?, ?);");            
    $prep_contract->execute([$date, $file_path, $res_agent[0]->id, $user_id, $property_id]);
    
    $prep_property_status = $db->prepare("UPDATE nekretnina SET status = ? WHERE id = ?;");
    $prep_property_status->execute([1, $property_id]);
    
    echo "<b>Ugovor je kreiran, osvežite stranicu!</b>";
} else {
    die (header('Location: ../agent_contract.php?msg=no_file_included'));
    exit();
}    
