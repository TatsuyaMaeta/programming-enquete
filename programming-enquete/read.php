<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataファイルを読み込んで表示するページ</title>
    <link rel="stylesheet" href="./css/style_for_post.css">
</head>
<body>
    <?php 
    // https://phpjavascriptroom.com/?t=php&p=mbstring

        $contents = file("data/data.txt");
        // echo var_dump($contents);

        // 登録してある人数が返り値
        $arr_length = count($contents);
        // echo $arr_length;
        
        // テキストファイルをまずは登録ごとで配列に格納する
        for ($i=0; $i < $arr_length; $i++) { 
            // echo $i."周目";
            // 名前直後のカンマ 0から始まるので事前にプラス１
            $org1 = mb_strpos($contents[$i], ',');
                
            // 年代直後のカンマ 0から始まるので事前にプラス１
            $org2 = mb_strpos($contents[$i], ',',$org1+1);

            // 性別直後のカンマ 0から始まるので事前にプラス１
            $org3 = mb_strpos($contents[$i], ',',$org2+1);

            // 配列閉じカッコ直後のカンマ 0から始まるので事前にプラス１
            $org4 = mb_strrpos($contents[$i], ' ]',$org3+1);
            
            // 配列自体の長さを取得
            $org5 = count($contents[$i]);

            // print_r($arr_length);
            // echo $org1."/";
            // echo $org2."/";
            // echo $org3."/";
            
            // nameだけを抽出
            $dbl_arr[$i][0]=mb_substr($contents[$i],0,$org1);

            // ageだけを抽出
            $dbl_arr[$i][1]=mb_substr($contents[$i],$org1+1,$org2-$org1-1);

            // genderだけを抽出
            $dbl_arr[$i][2]=mb_substr($contents[$i],$org2+1,$org3-$org2-1);

            // programmingだけを抽出
            $dbl_arr[$i][3]=mb_substr($contents[$i],$org3+2,$org4-2); //カッコで括っていた分１つ余計に数値を増やして処理

            // echo $contents[$i]."<br>";
            // echo var_dump($dbl_arr[$i])."<br>";
            // echo $dbl_arr;
        }
        // echo var_dump($dbl_arr)."<br>";

        // 配列を格納用に必ず必要！
        $total_pg=[];
        $under_30_total_pg=[];      //30歳未満の
        $under_40_total_pg=[];
        $under_70_total_pg=[];
        $gender_male_total_pg=[];
        $gender_female_total_pg=[];

        // $pg0 = explode(",", $dbl_arr[0][3]);
        // $pg1 = explode(",", $dbl_arr[0][3]);
        // $pg2 = explode(",", $dbl_arr[0][3]);
        // $pg3 = explode(",", $dbl_arr[0][3]);
        // $pg4 = explode(",", $dbl_arr[0][3]);
        // $pg5 = explode(",", $dbl_arr[0][3]);
        // $pg6 = explode(",", $dbl_arr[0][3]);
        echo "<br><br>";
        // echo var_dump($pg0);

        // 人数分の配列を回す
        for ($i=0; $i < $arr_length; $i++) { 
            // 配列の結合方法
            // https://www.sejuku.net/blog/28533

            // 年齢が何歳なのか判定
            if ($dbl_arr[$i][1] <= 29) {

                // チェックボックスで選択された項目を全て配列に格納
                $under_30_total_pg =array_merge($under_30_total_pg , explode(",", $dbl_arr[$i][3]));
                // echo $dbl_arr[$i][0]."の".$dbl_arr[$i][1]."は30才未満<br>";
            }else if ($dbl_arr[$i][1] <= 39) {
                // チェックボックスで選択された項目を全て配列に格納
                $under_40_total_pg =array_merge($under_40_total_pg , explode(",", $dbl_arr[$i][3]));
                // echo $dbl_arr[$i][0]."の".$dbl_arr[$i][1]."は40才未満<br>";
            }else if($dbl_arr[$i][1] <= 70) {
                // チェックボックスで選択された項目を全て配列に格納
                $under_70_total_pg =array_merge($under_70_total_pg , explode(",", $dbl_arr[$i][3]));
                // echo $dbl_arr[$i][0]."の".$dbl_arr[$i][1]."は70才未満<br>";
            }

            // 男性かどうかを判定
            if ($dbl_arr[$i][2] == "male") {
                // 男性が何人いるのかを配列に全て格納
                $gender_male_total_pg =array_merge($gender_male_total_pg, explode(",", $dbl_arr[$i][2]));
                // echo $dbl_arr[$i][0]."の".$dbl_arr[$i][1]."は30才未満<br>";
            }else{
                // 女性が何人いるのかを配列に全て格納
                $gender_female_total_pg =array_merge($gender_female_total_pg , explode(",", $dbl_arr[$i][2]));
                // echo $dbl_arr[$i][0]."の".$dbl_arr[$i][1]."は70才未満<br>";
            }


            // 配列の中の言語を１つの配列の中に詰め込む
            // https://www.sejuku.net/blog/28533
            $total_pg =array_merge($total_pg , explode(",", $dbl_arr[$i][3]));
        }

        // echo var_dump( $under_70_total_pg);
        echo "<br><br>";

        // 年代別
        $under_30_output = array_count_values($under_30_total_pg);
        $under_40_output = array_count_values($under_40_total_pg);
        $under_70_output = array_count_values($under_70_total_pg);

        // 性別
        $gender_male_output = array_count_values($gender_male_total_pg);
        $gender_female_output = array_count_values($gender_female_total_pg);

        // echo var_dump($under_30_output);
        // echo var_dump($under_40_output);
        // echo var_dump($under_70_output);
        // echo var_dump($total_pg);

        // echo var_dump($gender_male_total_pg);
        // echo var_dump($gender_female_total_pg);
        
        // javascirptへの受け渡し用にphpの配列をjsonデコード処理
        $json_list_under_30 = json_encode( $under_30_output , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        $json_list_under_40 = json_encode( $under_40_output , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        $json_list_under_70 = json_encode( $under_70_output , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

        $json_list_male = json_encode( $gender_male_output , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        $json_list_female = json_encode( $gender_female_output , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    ?>



<!-- ーーーーーーーーーーーーーーーーーーーーーーーーー -->

<canvas id="myBarChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

<script>

// パースしてphpから情報を受け取る
// https://qiita.com/cr_tk/items/900914e8a6e19ee3c5b7
var  js_list30 =JSON.parse('<?php echo $json_list_under_30; ?>'); 
var  js_list40 =JSON.parse('<?php echo $json_list_under_40; ?>'); 
var  js_list70 =JSON.parse('<?php echo $json_list_under_70; ?>'); 

var  js_list_male =JSON.parse('<?php echo $json_list_male; ?>'); 
var  js_list_female =JSON.parse('<?php echo $json_list_female; ?>'); 

console.log(js_list30);
console.log(typeof js_list30);
console.log(Object.keys(js_list30));
console.log(js_list30.length);
console.log("連想配列0番目のkey: " +Object.keys(js_list30)[0]);     // key:html
console.log("htmlのvalue: " + Object.values(js_list30)[0]);   // value:9


// valueから連想配列となっているkeyを取得する方法 ----------------------
// https://qiita.com/Test_test/items/7d532f445f2980e896d0
var find_value = 'python';
console.log("find_value =" + find_value);
const key_name = Object.keys(js_list30);
for (let i=0; i < key_name.length; i++) {
    let key = key_name[i];
    let val = js_list30[key];   //val = js_list30[key_name[i]]
    // console.log("key: " + key);
    // console.log("val: " + val);

    if (key == find_value) {
        console.log('index = ' + String(i));　　// 3
        break;
    }
}
// valueから連想配列となっているkeyを取得する方法 ----------------------


//最大値を取得
var $max_num =Object.values(js_list30)[0];  //初期値として配列の最初のvalueを代入
console.log("初期値の最大値: "+ $max_num);      //値の変化を確認するために初期値を表示
for (let i = 0; i < Object.values(js_list30).length; i++) {
    if ($max_num < Object.values(js_list30)[i]) {
        $max_num = Object.values(js_list30)[i]
    }
}
console.log("最終的な最大値"+$max_num);        //最終的な最大値を確認

// console.log(Object.keys(js_list30));
// console.log(js_list30.html);

// Object.keys(js_list30).forEach(function (key) {
//     console.log(key + "は" + js_list40[key] + "と関係がある！");
// });



// official Docs
// https://misc.0o0o.org/chartjs-doc-ja/

// Chart.jsでグラフを描画してみた
// https://qiita.com/Haruka-Ogawa/items/59facd24f2a8bdb6d369
var ctx = document.getElementById("myBarChart");

var myBarChart = new Chart(ctx, {
type: 'bar',
data: {
    labels:[Object.keys(js_list30)[0],   //html
            Object.keys(js_list30)[1],   //css
            Object.keys(js_list30)[2],   //javascript
            Object.keys(js_list30)[3],   //Ruby
            Object.keys(js_list30)[4],   //python
            Object.keys(js_list30)[5],   //'swift'
            Object.keys(js_list30)[6],   //'PHP'
            Object.keys(js_list30)[7],   //'Go'
            Object.keys(js_list30)[8],   //'Java'
            Object.keys(js_list30)[9],   //'VBA'
            Object.keys(js_list30)[10]   //'C'
            ],

    datasets: [
    {
        label: 'age-10~29',
        data:[Object.values(js_list30)[0],
            Object.values(js_list30)[1],
            Object.values(js_list30)[2], 
            Object.values(js_list30)[3],
            Object.values(js_list30)[4],    //js_list30.python, 
            Object.values(js_list30)[5],    //js_list30.swift, 
            Object.values(js_list30)[6],    //js_list30.php, 
            Object.values(js_list30)[7],    //js_list30.Go, 
            Object.values(js_list30)[8],    //js_list30.Java, 
            Object.values(js_list30)[9],    //js_list30.VBA, 
            Object.values(js_list30)[10]     //js_list30.C],
        ],
        backgroundColor: "rgba(219,39,91,0.5)"
    },{
        label: 'age-30~39',
        data: [js_list40.html, 
            js_list40.css, 
            js_list40.javascript, 
            js_list40.Ruby, 
            js_list40.python, 
            js_list40.swift, 
            js_list40.php, 
            js_list40.Go, 
            js_list40.Java, 
            js_list40.VBA, 
            js_list40.C
        ],
        backgroundColor: "rgba(130,201,169,0.5)"
    },{
        label: 'age-40~59',
        data: [js_list70.html, js_list70.css, js_list70.javascript, js_list70.Ruby, js_list70.python, js_list70.swift, js_list70.php, js_list70.Go, js_list70.Java, js_list70.VBA, js_list70.C],
        backgroundColor: "rgba(255,183,76,0.5)"
    }
    ]
},
options: {
    title: {
    display: true,
    text: "C's ∀cademy Kyoto 年代別 プログラミング言語嗜好一覧",
    fontSize: 36
    },
    scales: {
    yAxes: [{
        ticks: {
        suggestedMax: $max_num + 1,
        suggestedMin: 0,
        stepSize: 1,
        callback: function(value, index, values){
            return  value +"人"
        }
        }
    }]
    },
    layout: {                      //レイアウト
        padding: {                 //余白設定
            left: 10,
            right: 50,
            top: 0,
            bottom: 0
        }
    },
    responsive: true
}
});
</script>

<!-- ーーーーーーーーーーーーーーーーーーーーーーーーー -->



<canvas id="myPieChart"></canvas>

<script>
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
type: 'pie',
data: {
    labels: ["男性", "女性"],
    datasets: [{
        backgroundColor: [
            "#2B5179",
            "#F2F207",
        ],
        data: [
            js_list_male.male, 
            js_list_female.female
        ]
    }]
},
options: {
    title: {
    display: true,
    text: '新規入学者男女差 割合',
    fontSize: 36
    },
    responsive: true
}
});
</script>


</div>
</body>
</html>
