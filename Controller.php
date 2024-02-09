<?php
include("db.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
if ($_POST['Action'] == "AddQuiz") {
    $Questions =  $_POST['Questions'];
    //I made a new variable so that the funciton size of still works.
    $Q= mysqli_real_escape_string($conn,$_POST['Questions']);
    $Options = $_POST['Options'];
    $Answer = $_POST['Answers'];
    $title = $_POST['title'];
    $user = $_COOKIE['token'];
    $quizKey = uniqid();
    $n = sizeof($Questions);
    for ($i = 0; $i < $n; $i++) {
        $str_options =  mysqli_real_escape_string($conn,implode("|", $Options[$i]));
        $sql = "INSERT INTO questions (quizID_FK,title,options,answer) VALUES('$quizKey','$Q[$i]' , '$str_options' , '$Answer[$i]')";
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
    $fname = $_SESSION['fname'];
    session_unset();
    $sql = "SELECT answer FROM questions WHERE quizID_FK='$quizPublicID'";
    $result = mysqli_query($conn, $sql);
    $score = 0;
    $it = 0;
    while ($row = mysqli_fetch_array($result)) {
        if ((string) ($row['answer']) == ($UserAnswer[$it])) {
            $score++;
        }
        $it++;
    }
    $str_Ans = implode("|", $UserAnswer);
    $sql = "INSERT INTO history (host, guest, fname,guest_answers,score) VALUES ('$quizPublicID', '$token','$fname', '$str_Ans','$score')";
    mysqli_query($conn, $sql);
    echo json_encode($quizPublicID);
} elseif ($_POST["Action"] == "LoadHistory") {
    $quizPublicID = $_POST['QuizID'];
    $data = array();
    $sql2 = "SELECT * FROM history WHERE host='$quizPublicID' ORDER BY  (score) DESC";
    $result2 = mysqli_query($conn, $sql2);
    $finalResult = "";
    while ($history = mysqli_fetch_array($result2)) {
        $data[] = array(
            'guest' => htmlspecialchars($history["fname"], ENT_QUOTES, 'UTF-8'),
            'score' => htmlspecialchars($history["score"], ENT_QUOTES, 'UTF-8')
        );
    }
    if (empty($data)) {
        $data[] = array(
            'guest' => htmlspecialchars('لا اصدقاء', ENT_QUOTES, 'UTF-8'),
            'score' => ''
        );
    }
    echo json_encode($data);
}
