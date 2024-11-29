<?php
function conectar() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "papeleria_db";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>
