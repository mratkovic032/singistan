<?php
session_start();
if (isset($_POST['change_profile'])) {
    require 'database_connection.php';
    
    $tel_prefix = '+381';
    $name = htmlspecialchars($_POST['firstname']);
    $surname = htmlspecialchars($_POST['lastname']);
    $jmbg = htmlspecialchars($_POST['jmbg']);
    $address = htmlspecialchars($_POST['address']);
    $tel = htmlspecialchars($_POST['tel']);
    $tel_prefix .= $tel;
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    
    
    
    if ($_SESSION['user_type'] === "kupac") {
        $prep = $db->prepare("UPDATE kupac SET ime=?, prezime=?, jmbg=?, adresa=?, telefon=?, korisnicko_ime=?, sifra=?, email=? WHERE korisnicko_ime=?;");
        $prep->execute([$name,$surname,$jmbg,$address,$tel_prefix,$username,$password,$email,$_SESSION['username']]);
        
        if ($_FILES["file"]['name'][0] != '') {
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_name = $_FILES["file"]["name"];
            $file_type = $_FILES["file"]["type"];
            $file_path = "assets/img/profile_images/" . $file_name;
            
            $exploded_file_name = explode(".", $file_name);
            $file_ext = end($exploded_file_name);
            
            if (!preg_match("/\.(gif|jpg|png)$/i", $file_name)) {
                die (header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=not_pic'));
                exit();
            }
            
            $prep_delete = $db->prepare("SELECT putanja_slike FROM kupac WHERE korisnicko_ime = ?;");
            $prep_delete->execute([$_SESSION['username']]);
            $res_delete = $prep_delete->fetchAll(PDO::FETCH_OBJ);
            
            if ($res_delete[0]->putanja_slike != null) {
                $exploded_array = explode("/", $res_delete[0]->putanja_slike);
                $pic_name = end($exploded_array);
                $pic_to_delete = "../assets/img/profile_images/" . $pic_name;
                if (file_exists($pic_to_delete)) {
                    unlink($pic_to_delete);
                }
            }

            move_uploaded_file($file_tmp, "../assets/img/profile_images/" . $file_name);
            
            include_once 'image_resize.php';
            $target_file = "../assets/img/profile_images/" . $file_name;
            $resized_file = "../assets/img/profile_images/" . $file_name;
            $width_max = 800;
            $height_max = 800;
            img_resize($target_file, $resized_file, $width_max, $height_max, $file_ext);
            
            $prep2 = $db->prepare("UPDATE kupac SET putanja_slike=? WHERE korisnicko_ime=?;");
            $prep2->execute([$file_path, $_SESSION['username']]);
        }
        
        $_SESSION['username'] = $username;
        die (header('Location: ../profile.php?msg=success'));
    }
    elseif ($_SESSION['user_type'] === "agent") {
        $prep = $db->prepare("UPDATE agent SET ime='?', prezime='?', jmbg='?', adresa='?', telefon='?', korisnicko_ime='?', sifra='?', email='?' WHERE korisnicko_ime='?';");
        $prep->execute([$name,$surname,$jmbg,$address, $tel_prefix,$username,$password,$email,$_SESSION['username']]);
        
        if ($_FILES["file"]['name'][0] != '') {
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_name = $_FILES["file"]["name"];
            $file_type = $_FILES["file"]["type"];
            $file_path = "assets/img/profile_images/" . $file_name;
            
            $exploded_file_name = explode(".", $file_name);
            $file_ext = end($exploded_file_name);
            
            if (!preg_match("/\.(gif|jpg|png)$/i", $file_name)) {
                die (header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=not_pic'));
                exit();
            }
            
            $prep_delete = $db->prepare("SELECT putanja_slike FROM agent WHERE korisnicko_ime = ?;");
            $prep_delete->execute([$_SESSION['username']]);
            $res_delete = $prep_delete->fetchAll(PDO::FETCH_OBJ);
            
            if ($res_delete[0]->putanja_slike != null) {
                $exploded_array = explode("/", $res_delete[0]->putanja_slike);
                $pic_name = end($exploded_array);
                $pic_to_delete = "../assets/img/profile_images/" . $pic_name;
                if (file_exists($pic_to_delete)) {
                    unlink($pic_to_delete);
                }
            }

            move_uploaded_file($file_tmp, "../assets/img/profile_images/" . $file_name);
            
            include_once 'image_resize.php';
            $target_file = "../assets/img/profile_images/" . $file_name;
            $resized_file = "../assets/img/profile_images/" . $file_name;
            $width_max = 800;
            $height_max = 800;
            img_resize($target_file, $resized_file, $width_max, $height_max, $file_ext);
            
            $prep2 = $db->prepare("UPDATE agent SET putanja_slike=? WHERE korisnicko_ime=?;");
            $prep2->execute([$file_path, $_SESSION['username']]);
        }
        
        $_SESSION['username'] = $username;
        die (header('Location: ../profile.php?msg=success'));
    }
    
    
}

