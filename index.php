<?php
include 'db.php';
session_start();

$token = "";
// $check = !isset($_COOKIE['token']);
// if (!$check) {
//     $token = $_COOKIE['token'];
//     $sql = "SELECT name FROM users WHERE token='$token'";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_array($result);
//     if (empty($row['name']))
//         $check = true;
// } else {
//     $token = uniqid();
// }
if (isset($_POST["submit"])) {
    $_SESSION["check"]=0;
    $name = $_POST['name'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else
        $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $sql1 = "SELECT * FROM users WHERE token='$token'";
        $query1 = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_array($query1);
        if (empty($row["name"])) {
            $sql = "UPDATE users SET name='$name' WHERE token ='$token'";
            $_SESSION["check"] = 1;
        }
    } else {
        $token = uniqid();
        setcookie("token", $token, time() + 365.25 * 86400);
        $sql = "INSERT INTO users (name , ip , token) VALUES ('$name','$ip','$token')";
        $_SESSION["check"] = 1;
    }



    $result = mysqli_query($conn, $sql);
    header("location:index.php");
}

if (isset($_POST['newQuizSubmit'])) {
    $_SESSION['title'] = $_POST['title'];
    header("location:CreateQuiz.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="fontawsome/css/fontawesome.min.css">
    <link rel="stylesheet" href="fontawsome/css/solid.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="container mt-3">
        <h1 class="headline m-0">F<span class="rank">rank</span></h1>
        <?php

        ?>
        <?php if (!isset($_SESSION['check'])):
            ?>
            <div class="row">
                <center>
                    <img src="image/eyes.gif" alt="saly eyes" width="300">
                </center>
            </div>
            <form action="index.php" method="POST">
                <div class="row d-flex flex-column justify-content-center align-items-center">
                    <input type="text" class="homeBtn shadow-sm text-end" autocomplete="false" placeholder="ادخل اسمك"
                        name="name" required>
                    <input class="btn btn-primary mt-3" style="width:250px" type="submit" value="البدء" name="submit">
                </div>
            </form>
        <?php else: ?>
            <div class="SuperCard shadow d-flex flex-column gap-2">
                <?php $token = $_COOKIE['token'];
                $sql3 = "SELECT * FROM quiz WHERE userID_FK='$token' AND isActive=1";
                $query3 = mysqli_query($conn, $sql3);
                if (mysqli_num_rows($query3) == 0): ?>
                    <h1 class="text-center my-1 fs-5 d-flex justify-content-center align-items-center">
                        لا يوجد اختبار حتي الان
                        <img src="image/pepe-noting.gif" alt="pepe" width="120">
                    </h1>
                <?php else:
                    while ($test = mysqli_fetch_array($query3)):
                        ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-2">
                                <input type="button" class="iconf btn btn-danger delete" quid="<?php echo $test['globalQuizID']; ?>"
                                    value="&#xf00d;">
                                <input type="button" class="iconf btn btn-primary copy" quid="<?php echo $test['globalQuizID']; ?>"
                                    value=" &#xf0c5;">
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <input type="radio" name="Quiz" id="<?php echo $test['globalQuizID']; ?>"
                                    value="<?php echo $test['globalQuizID']; ?>" class="form-check-input ms-3">
                                <label class="form-check-label" for="<?php echo $test['globalQuizID']; ?>">
                                    <h3 class="m-0">
                                        <?php echo $test['title']; ?>
                                    </h3>
                                </label>
                            </div>
                        </div>
                    <?php endwhile;
                endif;
                ?>
                <input type="button" id="newTest" class="btn btn-primary mt-3" value="إضافة جديد">
                <div class="finishScreen p-3">
                    <form action="" method="post" class="d-flex justify-content-center mt-2 gap-2">
                        <input type="submit" class="btn btn-primary shadow-sm" name="newQuizSubmit" value="أكمل">
                        <input type="text" name="title" class="form-control text-end shadow-sm" placeholder="عنوان لأختبار"
                            required>
                        <input type="button" id="cancel" class="btn btn-danger shadow-sm" value="إلغاء">
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['check'])):
                if($_SESSION['check']==1)
            ?>
            <div class="SuperCard shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>نقاط</th>
                            <th>الأسم</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id="Reciver">
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
<script src="jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.finishScreen').css('display', 'none');
        $("#cancel").click(function () {
            $('.finishScreen').fadeOut();
        });
        $("#newTest").click(function () {
            $('.finishScreen').fadeIn();
        });
        $('.copy').click(function () {
            var idVal = $(this).attr('quid');
            navigator.clipboard.writeText("http://localhost/Frank/startQuiz.php?q=" + idVal);
            var theP = this.parentNode.parentNode
            $(theP).addClass('copyDone');
            setTimeout(function () {
                $(theP).removeClass('copyDone');
            }, 2500);
        });
        $('.delete').click(function () {
            var idVal = $(this).attr('quid');
            $.ajax({
                url: "controller.php",
                method: "POST",
                data: {
                    Action: "DelQuiz",
                    quizID: idVal,
                },
                success: function () {
                    window.location.replace('index.php')
                },
            })
        })
        $('input[name="Quiz"]').change(function () {
            $.ajax({
                url: "Controller.php",
                method: "POST",
                type: "JSON",
                data: {
                    Action: "LoadHistory",
                    QuizID: $(this).val(),
                }, success: function (Res) {
                    var htmlResult = "";
                    var data = JSON.parse(Res);
                    var x = 1;
                    data.forEach(function (history) {
                        htmlResult += "<tr class=\"" + (x == 1 ? "table-warning" : "") + "\"><th>" + history.score + "</th><th>" +
                            history.guest + " </th><th>" + (x == 1 ? "<span class=\"rank\">BFF</span>" : x) + "</th></tr>"; x++;
                    });
                    $("#Reciver").html(htmlResult);
                }
            });
        });
        $('input[name="Quiz"]').eq(0).click();
    });
</script>

</html>