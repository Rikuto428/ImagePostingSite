<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="./css/upload.css">
    <meta charset="UTF-8">
    <title>お弁当.com</title>
</head>

<body>

    <?php include('./header.php'); ?>

    <section>
        <div class="wrapper_main">
            <h1 class="mod-title">投稿をする</h1>

            <form method="post" enctype="multipart/form-data" action="upuload_check.php">
                <div class="img_upload">
                    <input class="img_form" type="file" name="image" id="input">
                </div>
                <p>コメント：</p>
                <textarea name="message" rows="5" cols="80"></textarea>
                <br>
                <input id="submit_button" type="submit" value="投稿する">
            </form>

        </div>
    </section>

    <?php include('./footer.php'); ?>

</body>

</html>