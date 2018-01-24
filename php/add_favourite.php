<?php

if (isset($_GET['user_id']) && isset($_GET['property_id'])) {
    require 'database_connection.php';

    $prep_alrady_in_favourites = $db->prepare("SELECT * FROM lista_zelja WHERE id_kupac = ? AND id_nekretnina = ?;");
    $prep_alrady_in_favourites->execute([$_GET['user_id'], $_GET['property_id']]);    
    
    if ($prep_alrady_in_favourites->rowCount() > 0) {
        die (header('Location: ' . $_SERVER['HTTP_REFERER'] . '&msg=already_in_favourites'));
    }
    
    $prep = $db->prepare("INSERT INTO lista_zelja (id_kupac, id_nekretnina) VALUES (?, ?);");
    $prep->execute([$_GET['user_id'], $_GET['property_id']]);
    
    die (header('Location: ' . $_SERVER['HTTP_REFERER'] . '&msg=succesfully_added_to_favourites'));
}