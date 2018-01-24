<?php
 require 'database_connection.php';
 
 $id = (int) @$_REQUEST['ID'];

 $prep = $db->prepare('SELECT id, id_nekretnina FROM gledanje_nekretnine WHERE id_kupac=?;');
 $prep->execute([$id]);
 $prep->fetch();
 
 $prep1 = $db->prepare('SELECT id, id_nekretnina FROM ugovor WHERE id_kupac=?;');
 $prep1->execute([$id]);
 $prep1->fetch();
($prep->rowCount())+($prep1->rowCount());
 if (($prep->rowCount())+($prep1->rowCount()) > 0) {
 

  die (header('Location: ../customers.php?msg=delete_restrict'));
 }
    else {
        $prep_delete_pic = $db->prepare('SELECT putanja_slike FROM kupac WHERE id=?;');
        $prep_delete_pic->execute([$id]);
        $res_delete_pic = $prep_delete_pic->fetchAll(PDO::FETCH_OBJ);
        
        if ($res_delete_pic[0]->putanja_slike != null) {
            $exploded_array = explode("/", $res_delete_pic[0]->putanja_slike);
            $pic_name = end($exploded_array);
            $pic_to_delete = "../assets/img/profile_images/" . $pic_name;
            if (file_exists($pic_to_delete)) {
                unlink($pic_to_delete);
            }
        }
        
        $prep = $db->prepare('DELETE FROM kupac WHERE id=?;');
        $prep->execute([$id]);
        
        
         die (header('Location: ../customers.php?msg=success'));
}