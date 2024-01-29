<?php
$conn = mysqli_connect('localhost', 'root', '', 'frank');


if (isset($_POST["submit"])) {
    $token = uniqid();
    $name = $_POST['name'];
    $sql = "INSERT INTO users (user,token) VAlUES ('$name','$token') ";
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM history WHERE host='$name' ORDER BY score";
    $result2 = mysqli_query($conn, $sql2);
    $sql3 = "SELECT * FROM users WHERE user='$name'";
    $result3 = mysqli_query($conn, $sql3);
    $users = mysqli_fetch_array($result3);
    setcookie("token", $users['token'], time() + 86400 * 365.25);
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
        <form action="index.php" method="POST">
            <div class="row d-flex justify-content-center">
                <input type="text" class="homeBtn shadow-sm" autocomplete="false" placeholder="PLZ Enter your name"
                    name="name" required>
                <input class="btn btn-primary w-50 mt-3" type="submit" value="Let's Start" name="submit">
                <h1 class="headline m-0">F<span class="rank">rank</span></h1>
            </div>
        </form>
        <div class="row m-1 rounded-1">
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Score</th>
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
                        echo "<tr><th colspan='3'>sorry you dont seem to have history here yet</th></td>";
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>