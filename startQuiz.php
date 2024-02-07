<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لنبدأ</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<?php
$token = uniqid();
if (isset($_COOKIE['token']))
    $token = $_COOKIE['token'];
else {
    setcookie("token", $token, time() + 86400 * 360);
}
session_start();
$quizPublicID = $_GET['q'];
if (isset($_POST['send'])) {
    $name = $_POST['Uname'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else
        $ip = $_SERVER['REMOTE_ADDR'];
    $sql = "INSERT INTO users (fname, token,IP) VALUES ('$name','$token','$ip')";
    $query = mysqli_query($conn, $sql);
    $_SESSION['token'] = $token;
    $_SESSION['Quiz'] = $quizPublicID;
    header("location:Quiz.php");
}
$sql = "SELECT * FROM users CROSS JOIN quiz ON quiz.userID_FK = users.token WHERE globalQuizID='$quizPublicID'";
$query = mysqli_query($conn, $sql);
$fetch = mysqli_fetch_array($query);
if (isset($_GET['q'])) {
    $quizID = $_GET['q'];
    $sql = "SELECT * FROM quiz WHERE globalQuizID='$quizID'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
        include("error.php");
    } else { ?>

        <body>

            <div class="container mt-5">
                <?php
                $sql4 = "SELECT * from quiz WHERE userID_FK='$token' AND globalQuizID='$quizPublicID'";
                $query4 = mysqli_query($conn, $sql4);
                $title=mysqli_fetch_array($query4);
                if (mysqli_num_rows($query4) == 0):
                    ?>
                    <div class="SuperCard shadow mt-5">
                        <h4 class="fs-4 text-center">
                            🥰
                            <?php echo $fetch['name']; ?>
                            يدعوك لأختبار صداقه
                            🥰
                        </h4>
                    </div>
                    <?php

                    $sql2 = "SELECT * FROM history LEFT JOIN users ON history.guest= users.token  WHERE host='$quizPublicID' AND guest='$token'";
                    $query2 = mysqli_query($conn, $sql2);
                    $name = mysqli_fetch_array($query2);
                    if (mysqli_num_rows($query2) == 0):
                        ?>
                        <form action="" method="post" class="SuperCard shadow d-flex flex-column gap-2">
                            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
                            <input type="text" class="optionInput m-0" name="Uname" placeholder="الرجاء ادخال الاسم" id="username"
                                required>
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <span>اسم عشوائى</span>
                                <input type="checkbox" id="anon" onchange="anond(this)" value="1" class="form-check-input" name="check">
                            </div>
                            <input type="submit" class="btn btn-primary mt-2" value="يلا" name="send" id="">
                        </form>
                    <?php else: ?>
                        <div class="SuperCard shadow text-end">
                            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
                            <h2 class="text-center">لقد قمت بحل هذا بالفعل </h2>
                            <h4 class="text-center text-success fs-2">
                                👀
                                <?php echo $name['fname']; ?>
                                👀
                            </h4>
                            <h4 class="d-flex justify-content-center mb-3">
                                🎉 حققت
                                <?php echo $name['score']; ?> نقاط
                            </h4>
                            <center>
                                <a href="Quiz.php?id=<?php echo $quizID ?>&state=show" class="btn btn-primary px-4">إعرض حلى</a>
                                <a href="index.php" class="btn btn-secondary mx-2 px-4">إبدأ بصنع اختبار خاص بك</a>
                            </center>
                        </div>
                    <?php endif; ?>
                    <!-- SHOW THIS INSTEAD IF THE HOST USER TOKEN -->
                <?php else: ?>
                    <div class="SuperCard shadow">
                        <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
                        <h4 class="text-center text-success fs-2 mb-4">
                            📝
                            <?php echo $title['title']; ?>
                            📝
                        </h4>
                        <center>
                            <input type="button" class="btn btn-primary px-4" id="copy" value="إنسخ الرابط">
                            <a href="index.php" class="btn btn-secondary mx-2 px-4">إرجع</a>
                        </center>
                    </div>
                <?php endif; ?>
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
                            $i = 1;
                            $sql = "SELECT * FROM history LEFT JOIN users ON history.guest= users.token WHERE host='$quizPublicID' ORDER BY  (score) DESC";
                            $query = mysqli_query($conn, $sql);
                            while ($score = mysqli_fetch_array($query)): ?>
                                <tr <?php if ($i == 1)
                                    echo "class=\"table-warning\""; ?>>
                                    <th>
                                        <?php echo $score["score"]; ?>
                                    </th>
                                    <th>
                                        <?php if ($token == $score['token']): ?>
                                            <span style="color:red;">
                                                <?php echo $score['fname']; ?>
                                            </span>
                                        <?php else:
                                            echo $score['fname'];
                                        endif; ?>
                                    </th>
                                    <?php if ($i == 1): ?>
                                        <th class="rank">BFF</th>
                                    </tr>
                                <?php else: ?>
                                    <th class="rank">
                                        <?php echo $i ?>
                                    </th>
                                    </tr>
                                <?php endif;
                                    $i++;
                            endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </body>
        <!-- <?php }
} else {
    include("error.php");
} ?>
    <script src="jquery-3.6.4.min.js"></script>
    <script src="main.js"></script>
    -->
<script>
    function anond(e) {
        let ele = document.getElementById('username');
        if (e.checked) {
            var theNames = ['Frank', 'Franky', 'Fransis', 'Lemon', 'Flippy', 'Salamander'];
            var randomIndex = Math.floor(Math.random() * theNames.length);
            var randomElement = theNames[randomIndex];
            ele.value = randomElement;
            ele.setAttribute('readonly', 'true');
        } else {
            ele.value = "";
            ele.removeAttribute('readonly');
        }
    }
    document.getElementById('copy').addEventListener('click', function () {
        var idVal = this.getAttribute('quid');
        navigator.clipboard.writeText("http://localhost/Frank/startQuiz.php?q=" + idVal);
        this.value = "تم النسخ";
        setTimeout(function () {
            this.value = "إنسخ الرابط";
        }, 2000);
    });
</script>

</html>