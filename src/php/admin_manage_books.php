<?php
$mysqli = new mysqli("db", "root", "rootpassword", "library-db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
/* Carandang */
?>