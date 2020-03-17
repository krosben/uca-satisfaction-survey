<?php

require_once '../config/db.php';
$dsn = get_dsn();
$db = new PDO($dsn);
