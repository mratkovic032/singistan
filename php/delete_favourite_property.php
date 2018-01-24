<?php

if (isset($_GET['id'])) {
    require 'database_connection.php';
    
    $prep_delete_property = $db->prepare("DELETE FROM lista_zelja WHERE id_nekretnina = ?;");
    $prep_delete_property->execute([$_GET['id']]);
    
    die (header('Location: ../favourites.php?msg=succesfully_deleted_property'));
}

?>
