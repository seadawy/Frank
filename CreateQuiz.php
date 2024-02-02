<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['title'])):
        ?>
        <div class="container">
            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
            <form action="" id="theForm" method="POST">
                <input type="hidden" id="QuizTitle" value="<?php echo $_SESSION['title'] ?>">
                <div class="SuperCard shadow d-flex">
                    <div class="col d-flex justify-content-start">
                        <input type="button" class="btn btn-primary indexed" id="prev" style="rotate: 180deg;" value="⮞">
                    </div>
                    <div class="d-flex justify-content-center flex-wrap g-2" id="indexGraid">
                        <input type="button" class="btn indexed active" numeric="0" value="١">
                        <input type="button" class="btn btn-primary" id="AddQuestion" value="+">
                    </div>
                    <div class="col d-flex justify-content-end">
                        <input type="button" class="btn indexed btn-primary" id="next" value="⮞">
                    </div>
                </div>
                <div id="alert" class="SuperCard shadow " style="display:none">
                    <h5 class="text-danger text-end m-0">الرجاء ملئ جميع الحقول</h5>
                </div>
                <div class="row SuperCard shadow" id="SuperCard">
                    <input type="text" class="questionInput shadow-sm my-2" placeholder="ادخل سؤال" required>
                    <hr>
                    <div id="options">
                        <div class="form-check optionGroup" id="option1">
                            <input class="form-check-input" type="radio" name="answerCheck" value="1" required>
                            <input type="text" class="optionInput" placeholder="ادخل إختيار" required>
                        </div>
                        <div class="form-check optionGroup" id="option2">
                            <input class="form-check-input" type="radio" name="answerCheck" value="2" required>
                            <input type="text" class="optionInput" placeholder="ادخل إختيار" required>
                        </div>
                    </div>
                    <input type="button" value="+ إضافة اختيار +" onclick="AddOption()" class="btn btn-primary">
                    <div class="finishScreen">
                        <h2 class="finishtext my-5"></h2>
                        <input type="button" class="btn btn-primary w-100" id="realfinish" value="إرسال">
                        <input type="button" class="btn btn-danger mt-2 w-100 " id="cancelScreen" value="إلغاء">
                    </div>
                </div>
                <div class="SuperCard shadow">
                    <input type="button" class="btn btn-primary w-100 finish mt-2" value="تم الأنتهاء">
                </div>
            </form>
        </div>
    <?php else:
        include 'error.php';
    endif; ?>
</body>
<script src="jquery-3.6.4.min.js"></script>
<script src="main.js"></script>

</html>