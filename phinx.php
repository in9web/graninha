<?php
require 'config.php';

return array(
    "paths"         => array(
        "migrations"    => "database/migrations",
        "seeds"         => "database/seeds"
    ),
    "environments"  => array(
        "default_migration_table"   => "phinxlog",
        "default_database"          => "defauldb",
        "defauldb" => array(
            "adapter"   => DB_CONNECTION,
            "host"      => DB_HOST,
            "name"      => DB_NAME,
            "user"      => DB_USER,
            "pass"      => DB_PASS,
            "port"      => DB_PORT,
            "charset"   => DB_CHARSET,
            /*"name"      => "dev_db",
            "connection" => $pdo_instance*/
        )
    )
);