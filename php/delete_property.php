<?php

if (isset($_GET['id'])) {
    require 'database_connection.php';
    
    $prep_delete_property = $db->prepare("DELETE FROM nekretnina WHERE nekretnina.id = ?;");
    $prep_delete_property->execute([$_GET['id']]);
    
    $prep_favouries = $db->prepare("SELECT * FROM lista_zelja WHERE id_nekretnina = ?;");
    $prep_favouries->execute([$_GET['id']]);                
    
    if ($prep_favouries->rowCount() > 0) {
        $prep_delete_favourite = $db->prepare("DELETE FROM lista_zelja WHERE id_nekretnina = ?;");
        $prep_delete_favourite->execute([$_GET['id']]);        
    }        
    
    $prep_pictures = $db->prepare("SELECT * FROM slika WHERE id_nekretnina = ?;");
    $prep_pictures->execute([$_GET['id']]);
    
    if ($prep_pictures->rowCount() > 0) {
        $prep_delete_picture = $db->prepare("DELETE FROM slika WHERE id_nekretnina = ?;");
        $prep_delete_picture->execute([$_GET['id']]);        
    }
    
        
    $property_folder_to_delete = getcwd() . "/../assets/img/property_images/" . $_GET['id'];
    if (is_dir($property_folder_to_delete)) {  
        $dir_opened = opendir($property_folder_to_delete);
        while ($file = readdir($dir_opened)) {
            if ($file != "." && $file != "..") {
                unlink($property_folder_to_delete . "/" . $file);
            }
        }
        closedir($dir_opened);
        rmdir($property_folder_to_delete);
    }
    
    die (header('Location: ../property_list.php?msg=succesfully_deleted_property'));
}

?>

