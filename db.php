<?php
$conn = new mysqli("localhost", "root", "", "devclub_db");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
