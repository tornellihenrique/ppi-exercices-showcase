<?php

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "ppi_activities");

function connect() {
    $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
    if ($conn->connect_error)
        throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);

    return $conn;
}

?>