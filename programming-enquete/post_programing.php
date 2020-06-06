<!DOCTYPE html>
<html lang="ja">
<head>
<?php
//文字作成
// $str = date("Y-m-d H:i:s");
// test

    include("funcs.php");
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $programming = $_POST["programming"];

    $programmings = implode(",", $programming);
    // var_dump($programmings);

    $kakko1= "[";
    $kakko2= "]";
    $c =",";

    $str = $name.$c.$age.$c.$gender.$c.$kakko1.$programmings.$kakko2;
    // if (strpos(h($name),"script") !== false ) {
        //File書き込み
        $file = fopen("data/data.txt","a");	// ファイル読み込み
        fwrite($file, $str."\n");
        fclose($file);
    // }
    // echo h($name);

?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ送信先</title>
    <link rel="stylesheet" link="/css/style_for_post.css">
</head>
<body>
    
<?php

    ?>

    <table>
        <tr>
            <td>お名前(カナ)：</td>
            <td>
            <?php
                if ($name == "") {
                    echo "未入力です";
                }else if(strpos($name,'<script>') !== false){
                    echo "<div style='font-weight: bold;'>Scriptタグ仕込んでんじゃねぇ!!!</div>";
                }else{
                    echo h($name);
                    // echo "<br>";
                }
            ?>
            </td>
        </tr>
        <tr>
            <td>お名前（漢字）:</td>
            <td>
                <?php
                if ($age == "") {
                        echo "未入力です";
                    }else{
                        echo h($age)."代";
                        
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>性別:</td>
            <td>
                <?php
                if ($gender == "") {
                        echo "未入力です";
                    }else{
                        echo $gender;
                        
                }
                ?>
            </td>
        </tr>
        
        <tr>
            <td>好きな技術:</td>
            <td>
                <?php
                    if ($programming == "") {
                            echo "未入力です";
                            
                        }else{
                            foreach ($programming as $p) :
                                echo "<li>".$p."</li>";
                            endforeach;
                            // echo count($programming);
                    }
                ?>
            </td>
        </tr>

    </table>
    <p>上記内容にて登録いたしました</p>
    
    <a href="index.php">入力フォームへ戻る</a>
    <br><br>
    <a href="read.php" target="_blank" rel="C's Academy">集計結果を見る</a>


</body>
</html>
