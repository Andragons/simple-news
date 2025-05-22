<?php
$conn = new mysqli("localhost", "root", "", "web_berita");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
