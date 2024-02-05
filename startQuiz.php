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
if (isset($_COOKIE['token']))
    $token = $_COOKIE['token'];
else {
    $token = uniqid();
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
    $sql = "INSERT INTO users (name, token,IP) VALUES ('$name','$token','$ip')";
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
                <div class="SuperCard shadow mt-5">
                    <h4 class="fs-4 text-center">
                        🥰
                        <?php echo $fetch['name']; ?>
                        يدعوك لأختبار صداقه
                        🥰
                    </h4>
                </div>
                <?php
                $sql = "SELECT * FROM history LEFT JOIN users ON history.guest= users.token WHERE host='$quizPublicID' ORDER BY  (score) DESC";
                $query = mysqli_query($conn, $sql);
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
                        <center>
                            <h2>لقد قمت بحل هذا الامتحان بالفعل </h2>
                        </center>
                        <h4><span class="text-end">
                                الاسم:
                            </span>

                            <?php
                            echo $name['name']; ?>
                        </h4>
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
                            while ($score = mysqli_fetch_array($query)): ?>
                                <tr class="table-warning">
                                    <th>
                                        <?php echo $score["score"]; ?>
                                    </th>
                                    <th>
                                        <?php if ($_COOKIE['token'] == $score['token']): ?>
                                            <span style="color:red;">
                                                <?php echo $score['name']; ?>
                                            </span>
                                        <?php else:
                                            echo $score['name'];
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
</script>

</html>