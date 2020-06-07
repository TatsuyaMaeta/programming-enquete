<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmingに関するアンケートのお願い</title>
    <link rel="stylesheet" href="./css/style_for_post.css">
</head>
<body>
<p>C's ∀cademy Kyoto に新規御入学者様へのアンケート</p>
<form action="post_programing.php" method="post" id="form-table">
        <table>

            <tr>
                <tr>
                    <td>お名前</td>
                    <td><input type="text" name="name" id="name" size="30"></td>                
                </tr>
                <td>年齢</td>
                <td>
                    <select name="age" id="age">
                        <option value="10">10代</option>
                        <option value="20">20代</option>
                        <option value="30">30代</option>
                        <option value="40">40代</option>
                        <option value="50">50代</option>
                        <option value="60">60代</option>
                        <option value="70">70代</option>
                    </select>
                </td>                
            </tr>
            
            <tr>
                <td>性別</td>
                <td>
                    <label for="male">
                        <input type="radio" name="gender" value="male" id="male">男性  
                    </label>
                    <label for="female">
                        <input type="radio" name="gender" value="female" id="female">女性
                    </label>                
                </td>                
            </tr>
            <tr>
                <td>好きな言語</td>
                <td>
                    <label for="html">
                        <input type="checkbox" name="programming[]" value="html" id="html">HTML
                    </label>
                    <label for="css">
                        <input type="checkbox" name="programming[]" value="css" id="css">CSS
                    </label>
                    <label for="javascript">
                        <input type="checkbox" name="programming[]" value="javascript" id="javascript">Javascript
                    </label>
                    <br>
                    <label for="php">
                        <input type="checkbox" name="programming[]" value="php" id="php">PHP
                    </label>
                    <label for="python">
                        <input type="checkbox" name="programming[]" value="python" id="python">Python
                    </label>
                    <label for="swift">
                        <input type="checkbox" name="programming[]" value="swift" id="swift">Swift
                    </label>
                    <br>
                    <label for="Ruby">
                        <input type="checkbox" name="programming[]" value="Ruby" id="Ruby">Ruby
                    </label>
                    <label for="Java">
                        <input type="checkbox" name="programming[]" value="Java" id="Java">Java
                    </label>
                    <label for="C">
                        <input type="checkbox" name="programming[]" value="C" id="C">C
                    </label>
                    <label for="Go">
                        <input type="checkbox" name="programming[]" value="Go" id="Go">Go
                    </label>
                    <label for="VBA">
                        <input type="checkbox" name="programming[]" value="VBA" id="VBA">VBA
                    </label>

                </td>                
            </tr>
        </table>
        <input type="submit" value="送信">
    </form>
    
</body>
</html>
