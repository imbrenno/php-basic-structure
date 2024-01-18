<?php


require_once('settings.php');
require_once('model\database.php');

Database::select("select * from users");