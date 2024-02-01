<?php
include("db.php");
if (isset($_POST['check'])) {
    $names = ['Frank', 'Franky', 'Fransis', 'Funky', 'Flippy'];
    $name = array_rand($names);
    $token = uniqid();
    $sql = "INSERT INTO users (name, token) VALUES ('$name','$token')";
    $query = mysqli_query($conn, $sql);
    setcookie("token", $token, time() + 86400 * 7);
}
?>