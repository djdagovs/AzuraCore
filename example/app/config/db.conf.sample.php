<?php
/**
 * Database configuration and credentials.
 */

return array(
    // Backend driver to use with the database.
    'driver'        => 'pdo_mysql',

    // Host or IP to connect to (default: localhost).
    'host'          => 'localhost',

    // Name of the primary application database.
    'dbname'        => 'app_test',

    // Username for the database user with read/write access to the above database.
    'user'          => 'root',

    // Password for the user account specified above.
    'password'      => 'password',

    // Character set.
    'charset'       => 'utf8',

    // Other options to send to the PDO adapter for the database.
    'driverOptions' => array(
        1002    => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
    ),
);