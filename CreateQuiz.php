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
        <div class="row SuperCard shadow">
            <h3 class="title">Question number #</h3>
            <input type="text" class="questionInput shadow-sm mb-3" placeholder="Set Question number #">
            <hr>
            <h3 class="title">Options</h3>
            <div class="form-check optionGroup">
                <input class="form-check-input" type="radio" name="flexRadioDefault">
                <input type="text" class="optionInput" placeholder="Option 1">
            </div>
            <div class="form-check optionGroup">
                <input class="form-check-input" type="radio" name="flexRadioDefault">
                <input type="text" class="optionInput" placeholder="Option 2">
            </div>
            <div class="form-check optionGroup">
                <input class="form-check-input" type="radio" name="flexRadioDefault">
                <input type="text" class="optionInput" placeholder="Added Option 3">
                <input type="button" class="btn cancel" value="X">
            </div>
            <input type="text" value="+ Add Option +" class="btn btn-primary">
            <div class="superCardFooter">
                <center>
                    <input type="submit" value="Previous" class="btn btn-primary">
                    <input type="submit" value="Next" class="btn btn-primary">
                    <input type="submit" value="Add More Question" class="btn btn-primary">
                    <input type="submit" value="Delete" class="btn btn-primary">
                </center>
            </div>
        </div>
        <center>
            <input type="submit" value="Finish" class="btn btn-primary finish m-3">
        </center>

    </div>
    </div>
</body>

</html>