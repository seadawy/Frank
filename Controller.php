<?php
if ($_POST['Action'] == "AddQuestion") {
    $Questions = $_POST['Questions'];
    $Options = $_POST['Options'];
    $Answer = $_POST['Answers'];
    echo json_encode($Questions);
    echo json_encode($Options);
    echo json_encode($Answer);
}