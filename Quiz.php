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
    <style>
        .SuperCard {
            min-width: 100%;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (true) : ?>
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
            <div class="slider">
                <?php
                $i = 0;
                while ($fetch = mysqli_fetch_array($query)) :
                    $option = explode("|", $fetch["options"]);
                ?>
                    <div class="row SuperCard shadow-sm">
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
            </div>
        <?php else :
        include 'error.php';
    endif;
        ?>
        </div>
</body>
<script src="jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        let currentIndex = 0;
        const $slider = $('.slider');
        const $slides = $('.SuperCard');
        $slides.fadeOut();
        const totalSlides = $slides.length - 1;

        $('#next').on('click', function() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider();
        });

        $('#prev').on('click', function() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlider();
        });

        function updateSlider() {
            const translateValue = -currentIndex * 100 + '%';
            $slider.css('transform', 'translateX(' + translateValue + ')');
        }
    });
</script>

</html>