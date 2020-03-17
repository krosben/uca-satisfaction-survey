<?php

$db_name = getenv('DB_NAME');
$db_host = getenv('DB_HOST');
$dn_port = getenv('DB_PORT');

function get_dsn(): string
{
    return 'mysql:host='.$db_host.';port='.$db_port.':dbname='.$db_name;
}
