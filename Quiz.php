<?php
include("db.php");
session_start();
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
    if (isset($_SESSION['token']) && isset($_SESSION['Quiz'])) : ?>
        <?php
        $token = $_SESSION['token'];
        $quizPublicID = $_SESSION['Quiz'];
        $sql = "SELECT * FROM questions WHERE quizID_FK='$quizPublicID'";
        $query = mysqli_query($conn, $sql);
        ?>
        <div class="container">
            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
            <div class="SuperCard shadow d-flex">
                <div class="col d-flex justify-content-start">
                    <input type="button" class="btn btn-primary indexed" id="prev" style="rotate: 180deg;" value="⮞">
                </div>
                <div class="d-flex justify-content-center flex-wrap g-2" id="indexGraid">
                    <input type="button" class="btn indexed active " numeric="0" value="١">
                </div>
                <div class="col d-flex justify-content-end">
                    <input type="button" class="btn indexed btn-primary" id="next" value="⮞">
                </div>
            </div>
            <?php
            $i = 0;
            while ($fetch = mysqli_fetch_array($query)) :
                $option = explode("|", $fetch["options"]);
            ?>
                <div class="row SuperCard QuestionCard shadow-sm">
                    <h1 class="fs-2 text-end">
                        <?php echo $fetch["title"]; ?>
                    </h1>
                    <hr>
                    <div id="options">
                        <?php
                        $n = sizeof($option);
                        for ($s = 0; $s < $n; $s++) : ?>
                            <div class="optionGroup justify-content-start" id="option1">
                                <input class="form-check-input" type="radio" name="answerCheck<?php echo $i ?>" value="<?php echo $s; ?>" required>
                                <h1 class="fs-4 m-0 text-end">
                                    <?php echo $option[$s]; ?>
                                </h1>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php
                $i++;
            endwhile; ?>
            <div class="SuperCard shadow" id="lastQ">
                <input type="button" class="btn btn-primary w-100 finish mt-2" value="تم الأنتهاء">
            </div>
        <?php else :
        include('error.php');
    endif;
        ?>
        </div>
</body>
<script src="jquery-3.6.4.min.js"></script>
<script>
    String.prototype.toArabic = function() {
        var id = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return this.replace(/[0-9]/g, function(w) {
            return id[+w];
        });
    };
    $(document).ready(function() {
        let currentIndex = 0;
        let $slider = $('.slider');
        let $slides = $('.QuestionCard');
        let totalSlides = $slides.length;
        $("#lastQ").hide();
        $slides.hide();
        $slides.eq(0).show();
        $('#next').on('click', function() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        });

        $('#prev').on('click', function() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlider();
        });

        function updateSlider() {
            $slides.hide();
            $slides.eq(currentIndex).fadeIn();
            $('.indexed').removeClass('active');
            $('#indexGraid .indexed').each(function(inx, ele) {
                if (inx == currentIndex) {
                    $(ele).addClass('active');
                }
            });
            if (currentIndex == totalSlides - 1) {
                $("#lastQ").fadeIn();
            }
        }

        $(document).on('click', '#indexGraid .indexed', function() {
            currentIndex = $(this).attr("numeric");
            updateSlider();
        });

        for (let i = 1; i < totalSlides; i++) {
            var newbutton = $('<input>', {
                type: "button",
                class: "btn indexed",
                numeric: i,
                value: (i + 1).toString().toArabic()
            })
            $('#indexGraid').append(newbutton);

        }
    });
</script>

</html>