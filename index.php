<?php
$conn = mysqli_connect('localhost', 'mostafa', '123456', 'frank');


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
                <input type="text" class="homeBtn  shadow-sm" placeholder="PLZ Enter your name" name="name">
                <input class="btn btn-primary w-fit" type="submit" value="Submit" name="submit">
                <h1 class="headline m-0">F<span class="rank">rank</span></h1>
            </div>
        </form>
        <div class="row m-1 rounded-1">
            <?php if(isset($_COOKIE['token'])) :?>
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <?php while ($history = mysqli_fetch_array($result2)): ?>
                    <tbody>
                        <tr class="table-warning">
                            <th class="rank">BFF</th>
                            <th>
                                <?php echo $history["guest"]; ?>
                            </th>
                            <th>
                                <?php echo $history["score"]; ?>
                            </th>
                        </tr>
                        <!-- <tr>
                            <th>2</th>
                            <th>seadawy 2</th>
                            <th>seadawy 11</th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>seadawy 3</th>
                            <th>seadawy 10</th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>seadawy 4</th>
                            <th>seadawy 5</th>
                        </tr> -->
                    </tbody>
                <?php endwhile; ?>
                <?php else: echo "sorry you dont seem to have history here yet";
                endif; ?>
            </table>
        </div>
    </div>
</body>

</html>