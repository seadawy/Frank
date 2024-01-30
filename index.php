<?php
$conn = mysqli_connect('localhost', 'root', '', 'frank');


if (isset($_POST["submit"])) {
    $token = uniqid();
    $name = $_POST['name'];
    /* INSERT USER */
    $sql = "INSERT INTO users (name,token) VAlUES ('$name','$token') ";
    $result = mysqli_query($conn, $sql);
    /* HISTORY */
    $sql2 = "SELECT * FROM history WHERE host='$name' ORDER BY score";
    $result2 = mysqli_query($conn, $sql2);
    /*  */
    setcookie("token", $token, time() + 86400 * 365.25);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <center>
                <img src="eyes.gif" alt="saly eyes" width="300">
            </center>

        </div>
        <?php if (!isset($_COOKIE['token'])): ?>
            <form action="index.php" method="POST">
                <div class="row d-flex flex-column justify-content-center align-items-center">
                    <input type="text" class="homeBtn shadow-sm text-end" autocomplete="false" placeholder="ادخل اسمك"
                        name="name" required>
                    <input class="btn btn-primary mt-3" style="width:250px" type="submit" value="البدء" name="submit">
                </div>
            </form>
        <?php else: ?>
            <div class="row d-flex flex-column justify-content-center align-items-center">
                <input class="btn btn-primary mt-3" style="width:250px" type="submit" value="إبدأ بتجهيز إختبار لأصدقائك"
                    name="submit">
            </div>
            </form>
        <?php endif; ?>
        <h1 class="headline m-0">F<span class="rank">rank</span></h1>
        <div class="row m-1 rounded-1">
            <table class="table ">
                <thead>
                    <tr>
                        <th>نقاط</th>
                        <th>الأسم</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_COOKIE['token'])): ?>
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
                    <?php else:
                        echo "<tr><th colspan='3'>ليس هناك اى مشاركين الى الأن</th></td>";
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>