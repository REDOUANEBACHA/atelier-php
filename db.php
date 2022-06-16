<?php
$dsn = 'mysql:host=localhost;dbname=gestion_de_stock';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}