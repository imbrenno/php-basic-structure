<?php


require_once('settings.php');
require_once('src/model/database.php');


$teste = Database::select("select * from users");
var_dump($teste);
