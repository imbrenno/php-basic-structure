<?php

require __DIR__ . '/vendor/autoload.php';

use Src\Database\Repository\CreateTables;

$createTables = new CreateTables();
$result = $createTables->CreateTablesDb();
