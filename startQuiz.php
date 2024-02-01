<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لنبدأ</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="container mt-5">
        <form action="" method="post" class="SuperCard shadow d-flex flex-column mt-5 gap-2">
            <h1 class="headline mt-3">F<span class="rank">rank</span></h1>
            <input type="text" class="optionInput m-0" name="" id="username">
            <div class="d-flex justify-content-end align-items-center gap-2">
                <span>اسم عشوائى</span>
                <input type="checkbox" id="anon" onchange="anond()" class="form-check-input" name="">
            </div>
            <input type="button" class="btn btn-primary mt-2" value="يلا" name="" id="">
        </form>
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
    function anond() {
        let ele = document.getElementById('username');
        ele.disabled = !ele.disabled;
    }
</script>

</html>