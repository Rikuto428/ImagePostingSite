<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" type="text/css" href="./css/works.css">
    <meta charset="UTF-8">
    <title>お弁当.com</title>
</head>

<body>

    <?php include('./header.php'); ?>

    <section>
    	<div class="wrpper_main">
            <h1 class="mod-title">投稿を見る</h1>

            <div class="works">

                <ul>

                    <?php
                    $dir = './engage/upload/' ; // ディレクトリのパス
                    if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
                        while( ($file = readdir($handle)) !== false ) {
                            if( filetype( $path = $dir . $file ) == "file" ) {
                                // $file: ファイル名
                                // $path: ファイルのパス
                                switch ( exif_imagetype($path) ) {
                                    case IMAGETYPE_JPEG:
                                    $fname = basename($path,'.jpg');
                                    break;
                                    case IMAGETYPE_GIF:
                                    $fname = basename($path,'.gif');
                                    break;
                                    case IMAGETYPE_PNG:
                                    $fname = basename($path,'.png');
                                    break;
                                    default:
                                    header('Location: works.php');
                                    exit();
                                }

                                ?><li><?php

                                $url = './engage/'.$fname.'/'.$fname.'.php';
                                echo "<a href = '$url'><img id='work_img' src='$path'></a>";
                                ?>
                                <!-- <br>
                                <div class="colum">
                                    <img class='sumnail' src='' >

                                    <P>名前</P>
                                    
                                    <h4>いいね:<span>100</span>件</h4>
                                </div> -->
                            </li>
                            <?php
                            }
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </section>

    <?php include('./footer.php'); ?>

</body>

</html>