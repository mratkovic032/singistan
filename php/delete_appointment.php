<?php

if (isset($_GET['id'])) {
    require 'database_connection.php';

        $prep = $db->prepare('DELETE FROM gledanje_nekretnine WHERE id=?;');
        $prep->execute([$_GET['id']]);
        die (header('Location: ../agent_appointments.php?msg=success'));
}