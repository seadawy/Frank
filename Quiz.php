<?php
include("db.php");
$sql = "SELECT * FROM questions";
$query = mysqli_query($conn, $sql);

if (isset($_COOKIE['token'])) {
    $token = $_COOKIE["token"];
    $sql2 = "SELECT token FROM users WHERE token='$token'";
    $query2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($query2) == 0) {
        header("location:error.php");
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['guest'])):
        ?>
        <div class="container">
            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
            <?php
            $i = 0;
            while ($fetch = mysqli_fetch_array($query)):
                $option = explode("|", $fetch["options"]);
                ?>
                <div class="row SuperCard shadow" id="SuperCard">
                    <h1 class="fs-2 text-end">
                        <?php echo $fetch["title"]; ?>
                    </h1>
                    <hr>
                    <div id="options">
                        <?php
                        $n = sizeof($option);
                        for ($s = 0; $s < $n; $s++): ?>
                            <div class="optionGroup justify-content-start" id="option1">
                                <input class="form-check-input" type="radio" name="answerCheck" value="<?php echo $s; ?>" required>
                                <h1 class="fs-4 m-0 text-end">
                                    <?php echo $option[$s]; ?>
                                </h1>
                            </div>
                        <?php endfor; ?>
                        <div class="finishScreen" style="display: none;">
                            <h2 class="finishtext my-5"> جاهز لإرسال 0 سؤال </h2>
                            <input type="button" class="btn btn-primary w-100" id="realfinish" value="إرسال">
                            <input type="button" class="btn btn-danger mt-2 w-100 " id="cancelScreen" value="إلغاء">
                        </div>
                        <input type="button" class="btn btn-primary finish mt-2" value="ارسال">
                    </div>
                </div>
                <?php
                $i++;
            endwhile; ?>
        <?php else:
        include 'error.php';
    endif;
    ?>
    </div>
</body>

</html>