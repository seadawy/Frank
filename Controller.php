<?php
include("db.php");
if ($_POST['Action'] == "AddQuiz") {
    $Questions = $_POST['Questions'];
    $Options = $_POST['Options'];
    $Answer = $_POST['Answers'];
    $quizKey = uniqid();
    $user = $_COOKIE['token'];
    $n = sizeof($Questions);
    for ($i = 0; $i < $n; $i++) {
        $str_options = implode("|", $Options[$i]);
        $sql = "INSERT INTO questions (quizID_FK,title,options,answer) VALUES('$quizKey','$Questions[$i]' , '$str_options' , '$Answer[$i]')";
        mysqli_query($conn, $sql);
    }
    $sql = "INSERT INTO quiz (userID_FK,globalQuizID) VALUES ('$user','$quizKey')";
    mysqli_query($conn, $sql);
    echo json_encode($Questions);
}