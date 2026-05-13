<?php
$host = 'localhost';
$bbdd = 'gamezone';
$user = 'gamezone';
$pass = 'GameZoneClient2026@';

$conn = new mysqli($host, $user, $pass, $bbdd);

if ($conn->connect_error) {
    die('Error de connexió: ' . $conn->connect_error);
}
