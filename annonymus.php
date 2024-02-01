<?php
include("db.php");
if (isset($_POST['check'])) {
<<<<<<< HEAD
    $names = ['Frank', 'Franky', 'Fransis', 'Lemon', 'Flippy','Salamander'];
=======
    $names = ['Frank', 'Franky', 'Fransis', 'Funky', 'Flippy'];
>>>>>>> 940cfb7 (annonymus)
    $name = array_rand($names);
    $token = uniqid();
    $sql = "INSERT INTO users (name, token) VALUES ('$name','$token')";
    $query = mysqli_query($conn, $sql);
    setcookie("token", $token, time() + 86400 * 7);
}
?>