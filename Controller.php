<?php
include("db.php");
if ($_POST['Action'] == "AddQuestion") {
    $Questions = $_POST['Questions'];
    $Options = $_POST['Options'];
    $Answer = $_POST['Answers'];
    $str_questions = implode("|",) ;
    $str_options = implode("| ",$Options);
    $sql="INSERT INTO questions (title , options , answer) VALUES('$Questions' , '$str_options' , '$Answer')";
    $query = mysqli_query($conn , $sql);   
}