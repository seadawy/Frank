<?php
include("db.php");
session_start();
if ($_POST['Action'] == "AddQuiz") {
    $Questions = $_POST['Questions'];
    $Options = $_POST['Options'];
    $Answer = $_POST['Answers'];
    $title = $_POST['title'];
    $quizKey = uniqid();
    $user = $_COOKIE['token'];
    $n = sizeof($Questions);
    for ($i = 0; $i < $n; $i++) {
        $str_options = implode("|", $Options[$i]);
        $sql = "INSERT INTO questions (quizID_FK,title,options,answer) VALUES('$quizKey','$Questions[$i]' , '$str_options' , '$Answer[$i]')";
        mysqli_query($conn, $sql);
    }
    $sql = "INSERT INTO quiz (userID_FK,title,globalQuizID) VALUES ('$user','$title','$quizKey')";
    mysqli_query($conn, $sql);
    header("location:index.php");
} elseif ($_POST['Action'] == "DelQuiz") {
    $QID = $_POST['quizID'];
    $sql = "UPDATE `quiz` SET `isActive`= 0 WHERE globalQuizID='$QID'";
    mysqli_query($conn, $sql);
} elseif ($_POST["Action"] == "ResultQuiz") {
    $UserAnswer = $_POST['currentAns'];
    $token = $_SESSION['token'];
    $quizPublicID = $_SESSION['Quiz'];
    $sql = "SELECT answer FROM questions WHERE quizID_FK='$quizPublicID'";
    $result = mysqli_query($conn, $sql);
    $score = 0;
    $it = 0;
    while ($row = mysqli_fetch_array($result)) {
        if ((string) ($row['answer'] - 1) == ($UserAnswer[$it])) {
            $score++;
        }
        $it++;
    }
    $sql = "INSERT INTO history (host, guest, score) VALUES ('$quizPublicID', '$token', '$score')";
    mysqli_query($conn, $sql);
    echo json_encode($quizPublicID);
}
