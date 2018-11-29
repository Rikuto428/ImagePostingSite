<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="../../css/engage.css">
    <meta charset="UTF-8">
    <title>お弁当.com</title>
</head>

<body>

    <?php include('../header.php'); ?>

    <section>
        <div class="wrapper_main">
            <h1 class="mod-title">エンゲージメント</h1>

            <?php
                $s_uid  = $_SESSION["user_id"] ;
                $s_name = $_SESSION["user_name"] ;
                $s_prof = $_SESSION["user_prof"] ;
            ?>

            <div class="work_name-good">
                <img src="../../profile/P_Replacement" width=10%>
                <h4 class="name">N_Replacement</h4>
                <p>いいね<span>100</span>件</p>
            </div>
            <div class="work_main">
                <img src="../upload/W_Replacement">

                <?php
                $Description_file = './Description.txt';
                $fp = fopen($Description_file, 'rb');
                if ($fp){
                    if (flock($fp, LOCK_SH)){
                        while (!feof($fp)) {
                            $buffer = fgets($fp);
                            ?>
                            <p class="comment">
                                <?php print($buffer); ?>
                            </p>
                            <?php
                        }
                        flock($fp, LOCK_UN);
                    }else{
                        print('ファイルロックに失敗しました');
                    }
                }
                fclose($fp); // 作品説明のファイルからの読み込み
                ?>

                <div class="button">
                    <input type="button" value="いいね">
                </div>
            </div>

            <?php
            $comment_file = 'comment.txt';
            if (isset($_POST['message'])) {
                $contents = $_POST['message'];
                $contents = nl2br($contents);
                $data = "<hr>\r\n";
                $data = $data."<div class='engage'>\r\n";
                $data = $data."<div class='engage_main'>\r\n";
                $data = $data."<img src='../../profile/$s_prof' width='10%'>\r\n";
                $data = $data."<h4>$s_name</h4>\r\n";
                $data = $data."</div>\r\n";
                $data = $data."<p>".$contents."</p>\r\n";
                $data = $data."</div>\r\n";
                $fp = fopen($comment_file, 'ab');
                if ($fp){
                    if (flock($fp, LOCK_EX)){
                        if (fwrite($fp,  $data) === FALSE){
                            print('ファイル書き込みに失敗しました');
                        }
                        flock($fp, LOCK_UN);
                    }else{
                        print('ファイルロックに失敗しました');
                    }
                }
                fclose($fp);
            } //コメントのファイルへの書き込み

            if (file_exists($comment_file)) {
                $fp = fopen($comment_file, 'rb');
                if ($fp){
                    if (flock($fp, LOCK_SH)){
                        while (!feof($fp)) {
                            $buffer = fgets($fp);
                            print($buffer);
                        }
                        flock($fp, LOCK_UN);
                    }else{
                        print('ファイルロックに失敗しました');
                    }
                }
                fclose($fp);
            } //コメントのファイルからの読み込み
            ?>

            <hr>
            <div class="form_comment">
                <form method="post" enctype="multipart/form-data" action="<?php print($_SERVER['PHP_SELF']) ?>">
                    <textarea name="message" rows="5" cols="90"></textarea>
                    <input type="submit" value="コメントする">
                </form>
            </div>

        </div>
    </section>

    <?php include('../footer.php'); ?>

</body>

</html>