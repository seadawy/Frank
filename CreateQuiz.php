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
    <div class="container">
        <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
        <form action="" id="theForm" method="POST">
            <div class="row SuperCard shadow" id="SuperCard">
                <h3 class="title">السؤال</h3>
                <input type="text" class="questionInput shadow-sm mb-3" placeholder="ادخل سؤال" required>
                <hr>
                <h3 class="title">الأختيارات</h3>
                <div id="options">
                    <div class="form-check optionGroup" id="option1">
                        <input class="form-check-input" type="radio" name="answerCheck" value="1" required>
                        <input type="text" class="optionInput" placeholder="ادخل إختيار " required>
                    </div>
                    <div class="form-check optionGroup" id="option2">
                        <input class="form-check-input" type="radio" name="answerCheck" value="2" required>
                        <input type="text" class="optionInput" placeholder="ادخل إختيار" required>
                    </div>
                </div>
                <input type="button" value="+ إضافة اختيار +" onclick="AddOption()" class="btn btn-primary">
                <div class="d-flex justify-content-between mt-2">
                    <input type="button" value="إضافة سؤال" id="next" class="btn me-3 w-50 btn-primary nextButton">
                    <input type="button" value="السابق" id="prev" class="btn w-50 btn-primary">
                </div>
                <div class="finishScreen">
                    <h2 class="finishtext my-5"></h2>
                    <input type="button" class="btn btn-primary w-100" id="realfinish" value="إرسال">
                    <input type="button" class="btn btn-danger mt-2 w-100 " id="cancelScreen" value="إلغاء">
                </div>
                <input type="button" class="btn btn-primary finish mt-2">
            </div>
        </form>
    </div>
</body>
<script src="jquery-3.6.4.min.js"></script>
<script src="main.js"></script>

</html>