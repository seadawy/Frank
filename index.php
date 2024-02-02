<?php
include 'db.php';
session_start();
session_unset();
if (isset($_POST["submit"])) {
    $token = uniqid();
    $name = $_POST['name'];
    /* INSERT USER */
    $sql = "INSERT INTO users (name,token) VAlUES ('$name','$token')";
    $result = mysqli_query($conn, $sql);
    setcookie("token", $token, time() + 86400 * 365.25);
    header("location:index.php");
}

if (isset($_POST['newQuizSubmit'])) {
    $_SESSION['title'] = $_POST['title'];
    header("location:CreateQuiz.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- // remove all session variables
session_unset();

// destroy the session
session_destroy(); -->

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
        <?php if (!isset($_COOKIE['token'])): ?>
            <div class="row">
                <center>
                    <img src="eyes.gif" alt="saly eyes" width="300">
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
            <div class="SuperCard shadow d-flex flex-column">
                <?php $token = $_COOKIE['token'];
                $sql3 = "SELECT * FROM quiz WHERE userID_FK='$token'";
                $query3 = mysqli_query($conn, $sql3);
                if (mysqli_num_rows($query3) == 0) { ?>
                    <h1 class="text-end fs-5">
                        <?php echo 'لا يوجد اختبار حتي الان'; ?>
                    </h1>
                <?php } else {
                    while ($test = mysqli_fetch_array($query3)):
                        ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-2">
                                <input type="button" class="iconf btn btn-danger" quid="<?php $test['globalQuizID']; ?>" value="&#xf00d;">
                                <input type="button" class="iconf btn btn-primary" quid="<?php $test['globalQuizID']; ?>" value=" &#xf0c5;">
                            </div>

                            <div class="d-flex flex-row-reverse">
                                <input type="radio" name="" id="" class="form-check-input ms-3" checked>
                                <h3 class="m-0">
                                    <?php echo $test['title']; ?>
                                </h3>
                            </div>
                        </div>
                        <?php endwhile;
                } ?>
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
        <?php if (isset($_COOKIE['token'])): ?>
            <div class="SuperCard shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>نقاط</th>
                            <th>الأسم</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /* HISTORY */
                        $token = $_COOKIE['token'];
                        $sql2 = "SELECT * FROM history WHERE host='$token' ORDER BY score";
                        $result2 = mysqli_query($conn, $sql2);
                        ?>
                        <?php while ($history = mysqli_fetch_array($result2)): ?>
                            <tr class="table-warning">
                                <th class="rank">BFF</th>
                                <th>
                                    <?php echo $history["guest"]; ?>
                                </th>
                                <th>
                                    <?php echo $history["score"]; ?>
                                </th>
                            </tr>
                        <?php endwhile; ?>
                        <?php if (mysqli_num_rows($result2) < 1): ?>
                            <tr>
                                <th colspan='3'>ليس هناك اى مشاركين الى الأن</th>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
<script src="jquery-3.6.4.min.js"></script>
<script>
    $("#cancel").click(function () {
        $('.finishScreen').fadeOut();
    });
    $("#newTest").click(function () {
        $('.finishScreen').fadeIn();
    });
    $('.finishScreen').css('display', 'none');
</script>

</html>