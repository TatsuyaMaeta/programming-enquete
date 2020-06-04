<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            function h($str){
                $a = htmlspecialchars($str, ENT_QUOTES);
                return $a;
            }

            function red($str){
                return '<span style="color:red;">'.$str.'</span>';
            }
    ?>

</body>
</html>