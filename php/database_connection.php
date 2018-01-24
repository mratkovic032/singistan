<?php

$db = new PDO('mysql:host=localhost;dbname=singi_stan;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$database_name = "singi_stan";