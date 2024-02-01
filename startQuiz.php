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
include("db.php");
/* quiz pub id */
$quizPublicID = $_GET['q'];
if (isset($_POST['send'])) {
    $token = uniqid();
    $sql = "INSERT INTO users (name, token) VALUES ('$name','$token')";
    $query = mysqli_query($conn, $sql);
    setcookie("token", $token, time() + 86400 * 7);
}
?>
<!-- TO DO -->
<!-- MAKE SESSION -->

<body>
    <div class="container mt-5">
        <div class="SuperCard shadow mt-5">
            <h4 class="fs-4 text-center">
                <!-- TO DO -->
                <!-- غير سعداوى للأسم بتاع صاحب الاختبار
                 اللينك بيبقى فيه الفيربول -->
                🥰 سعداوى يدعوك لأختبار صداقه
            </h4>
        </div>
        <form action="" method="post" class="SuperCard shadow d-flex flex-column gap-2">
            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
            <input type="text" class="optionInput m-0" name="" placeholder="الرجاء ادخال الاسم" id="username">
            <div class="d-flex justify-content-end align-items-center gap-2">
                <span>اسم عشوائى</span>
                <input type="checkbox" id="anon" onchange="anond(this)" value="1" class="form-check-input" name="check">
            </div>
            <input type="button" class="btn btn-primary mt-2" value="يلا" name="send" id="">
        </form>
        <!-- TO DO -->
        <!-- FETCH THE HISTORY FROM THIS EXAM SCORE,NAME -->
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
                    <tr class="table-warning">
                        <th class="rank">BFF</th>
                        <th>
                            phweguest
                        </th>
                        <th>
                            echo54
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>
<!-- 
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
        } else {
            ele.value = "";
        }
        ele.disabled = !ele.disabled;
    }
</script>

</html>