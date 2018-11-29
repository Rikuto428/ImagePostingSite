<nav>
    <ul>

        <li id="logo">
            <a href="../../home.php"> <img src="../../image/logo.png" width="150" heght="10"></a>
        </li>
        <li><a href="../../home.php">HOME</a></li>

        <?php
        mb_language("japanese") ;
        mb_internal_encoding("utf-8") ;

        session_start();

        if(isset($_SESSION["user_id"])){
            print"<li><a href=\"../../works.php\">投稿を見る</a></li>";
            print"<li><a href=\"../../upload.php\">投稿する</a></li>";
            print"<li><a href=\"../../mypage.php\">マイページ</a></li>";
            print"<li><a href=\"../../logout.php\">ログアウト</a></li>";                
        }else{
            print"<li><a href=\"../../login.php\">ログイン</a></li>";     
        }
        ?>

    </ul>
</nav>