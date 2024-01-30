<?php
include("db.php");
$sql = "SELECT * FROM questions"; //add user tokin later
$query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<!-- saved from url=(0043)http://localhost/Frank/Frank/Createquiz.php -->
<html lang="ar" class="">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="./Quiz_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Quiz_files/home.css">
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="./Quiz_files/m=el_main_css">
</head>

<body>
    <div class="container">
        <h1 class="headline mt-3">F<span class="rank">rank</span></h1>

        <!-- start -->
        <?php $i = 0;
        while ($fetch = mysqli_fetch_array($query)):
            $option = explode("|", $fetch["options"]);

            ?>
            <div class="row SuperCard shadow" id="SuperCard">
                <h3 class="title">السؤال</h3>
                <h1 class="fs-4 text-end">
                    <?php echo $fetch["title"]; ?>
                </h1>
                <hr>
                <h3 class="title">الأختيارات</h3>
                <div id="options">
                    <?php
                    $n = sizeof($option);
                    for ($s = 1; $s <= $n; $s++): ?>
                        <div class="" id="option1">
                            <input class="form-check-input" type="radio" name="answerCheck" value="<?php echo $s; ?>"
                                required="">
                        <?php endfor;
                    for ($s = 0; $s < $n; $s++):
                        ?>
                            <h1 class="fs-5 text-end">
                                <?php echo $option[$s];
                     ?></h1>
                        <?php endfor; ?>
                        <div class="finishScreen" style="display: none;">
                            <h2 class="finishtext my-5"> جاهز لإرسال 0 سؤال </h2>
                            <input type="button" class="btn btn-primary w-100" id="realfinish" value="إرسال">
                            <input type="button" class="btn btn-danger mt-2 w-100 " id="cancelScreen" value="إلغاء">
                        </div>
                        <input type="button" class="btn btn-primary finish mt-2" value="ارسال">
                    </div> <!-- end -->
                   

            </div>
             <?php
                    $i++;
        endwhile; ?>

            <script src="./Quiz_files/jquery-3.6.4.min.js.download"></script>
            <script src="./Quiz_files/main.js.download"></script>
            <div id="goog-gt-tt" class="VIpgJd-yAWNEb-L7lbkb skiptranslate"
                style="border-radius: 12px; margin: 0 0 0 -23px; padding: 0; font-family: &#39;Google Sans&#39;, Arial, sans-serif;"
                data-id="">
                <div id="goog-gt-vt" class="VIpgJd-yAWNEb-hvhgNd">
                    <div class=" VIpgJd-yAWNEb-hvhgNd-l4eHX-i3jM8c"><img src="./Quiz_files/24px.svg" width="24"
                            height="24" alt=""></div>
                    <div class=" VIpgJd-yAWNEb-hvhgNd-k77Iif-i3jM8c">
                        <div class="VIpgJd-yAWNEb-hvhgNd-IuizWc" dir="ltr">Original text</div>
                        <div id="goog-gt-original-text" class="VIpgJd-yAWNEb-nVMfcd-fmcmS VIpgJd-yAWNEb-hvhgNd-axAV1">
                        </div>
                    </div>
                    <div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid ltr">
                        <div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid-B7I4Od ltr" dir="ltr">
                            <div class="VIpgJd-yAWNEb-hvhgNd-UTujCb">Rate this translation</div>
                            <div class="VIpgJd-yAWNEb-hvhgNd-eO9mKe">Your feedback will be used to help improve
                                Google
                                Translate</div>
                        </div>
                        <div class="VIpgJd-yAWNEb-hvhgNd-xgov5 ltr"><button id="goog-gt-thumbUpButton" type="button"
                                class="VIpgJd-yAWNEb-hvhgNd-bgm6sf" title="Good translation"
                                aria-label="Good translation" aria-pressed="false"><span id="goog-gt-thumbUpIcon"><svg
                                        width="24" height="24" viewBox="0 0 24 24" focusable="false"
                                        class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                        <path
                                            d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7H2v13h16c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM7 18H4V9h3v9zm14-7l-3 7H9V8l4.34-4.34L12 9h9v2z">
                                        </path>
                                    </svg></span><span id="goog-gt-thumbUpIconFilled"><svg width="24" height="24"
                                        viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                        <path
                                            d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7v13h11c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM5 7H1v13h4V7z">
                                        </path>
                                    </svg></span></button><button id="goog-gt-thumbDownButton" type="button"
                                class="VIpgJd-yAWNEb-hvhgNd-bgm6sf" title="Poor translation"
                                aria-label="Poor translation" aria-pressed="false"><span id="goog-gt-thumbDownIcon"><svg
                                        width="24" height="24" viewBox="0 0 24 24" focusable="false"
                                        class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                        <path
                                            d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7h5V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zM17 6h3v9h-3V6zM3 13l3-7h9v10l-4.34 4.34L12 15H3v-2z">
                                        </path>
                                    </svg></span><span id="goog-gt-thumbDownIconFilled"><svg width="24" height="24"
                                        viewBox="0 0 24 24" focusable="false" class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M">
                                        <path
                                            d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zm16 0h4V4h-4v13z">
                                        </path>
                                    </svg></span></button></div>
                    </div>
                    <div id="goog-gt-votingHiddenPane" class="VIpgJd-yAWNEb-hvhgNd-aXYTce">
                        <form id="goog-gt-votingForm"
                            action="http://translate.googleapis.com/translate_voting?client=te_lib" method="post"
                            target="votingFrame" class="VIpgJd-yAWNEb-hvhgNd-aXYTce"><input type="text" name="sl"
                                id="goog-gt-votingInputSrcLang"><input type="text" name="tl"
                                id="goog-gt-votingInputTrgLang"><input type="text" name="query"
                                id="goog-gt-votingInputSrcText"><input type="text" name="gtrans"
                                id="goog-gt-votingInputTrgText"><input type="text" name="vote"
                                id="goog-gt-votingInputVote"></form><iframe name="votingFrame" frameborder="0"
                            src="./Quiz_files/saved_resource.html"></iframe>
                    </div>
                </div>
            </div>

</body>

</html>