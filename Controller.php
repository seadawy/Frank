<?php
include("db.php");
if ($_POST['Action'] == "AddQuestion") {
    $Questions = $_POST['Questions'];
    $Options = $_POST['Options'];
    $Answer = $_POST['Answers'];
    $n = sizeof($Questions);
    for ($i = 0; $i < $n; $i++) {
        $str_options = implode("|", $Options[$i]);
        $sql = "INSERT INTO questions (title , options , answer) VALUES('$Questions[$i]' , '$str_options' , '$Answer[$i]')";
        $query = mysqli_query($conn, $sql);
    }
}