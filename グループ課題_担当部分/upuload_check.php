<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="./css/upload_check.css">
    <meta charset="UTF-8">
    <title>お弁当.com</title>
</head>

<body>

    <?php include('./header.php'); ?>

    <div class="wrapper_main">
        <div class="check">

            <?php
            $s_uid  = $_SESSION["user_id"] ;
            $s_name = $_SESSION["user_name"] ;
            $s_prof = $_SESSION["user_prof"] ;
            ?>

            <?php

            $filename = $_FILES['image']['name'] ;
            $old_name = $_FILES['image']['tmp_name'] ;
            $new_name = date("YmdHis");
            $new_name = $new_name.mt_rand();
            switch (exif_imagetype($_FILES['image']['tmp_name'])){
                case IMAGETYPE_JPEG:
                $new_name2 = $new_name.'.jpg';
                break;
                case IMAGETYPE_GIF:
                $new_name2 = $new_name.'.gif';
                break;
                case IMAGETYPE_PNG:
                $new_name2 = $new_name.'.png';
                break;
                default:
                header('Location: upload.php');
                exit();
            }
            $updir = "./engage/upload/";
            $saved = $updir.$new_name2;
            $file = basename($_FILES['image']['name']); // 画像の読み込み
            if(move_uploaded_file($old_name,$saved)){
                echo '<h1>投稿されました！</h1>';
                echo '<img src="', $saved, '">'; // 画像表示
            }else{
                $error = $_FILES['image']['error'] ;
                print "Upload failed : $error<br>" ;
                echo '<h1>投稿に失敗しました。</h1>';
            } // 画面表示部分

            $directory_path = "./engage/$new_name";
            if(file_exists($directory_path)){
                //存在確認
            }else{
                if(mkdir($directory_path, 0777)){
                    chmod($directory_path, 0777);
                }
            } //フォルダ生成

            if($_POST['message'] == ""){
                $_POST['message'] = 'コメントがありません。';
            }
            $message = $_POST['message'];
            $message = nl2br($message);
            print('<p>'.$message.'</p>');
            $data = $message;
            $Description_file = './engage/'.$new_name.'/Description.txt';
            $fp = fopen($Description_file, 'ab');
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
            fclose($fp); // コメントのファイルへの書き込み

            $url ="./engage.php";
            $buff = file_get_contents($url);
            $buff_P = preg_replace('/P_Replacement/', $s_prof, $buff);
            $buff_N = preg_replace('/N_Replacement/', $s_name, $buff_P);
            $buff_W = preg_replace('/W_Replacement/', $new_name2, $buff_N);
            $fname = './engage/'.$new_name.'/'.$new_name.'.php';
            $fhandle = fopen($fname,"w");
            fwrite($fhandle,$buff_W);
            fclose($fhandle); // 作品個別ページ自動生成

            ?>

        </div>
        <div class="button">
            <a href="works.php"><input type=button value="戻る"></a>
        </div>
    </div>
    
    <?php include('./footer.php'); ?>

</body>

</html>