<?php
include 'db.php';
include 'auth.php';

$id = $_GET['id'];
$conn->query("DELETE FROM members WHERE member_id=$id");
header("Location: index.php");
