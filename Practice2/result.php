<!DOCTYPE html>
<html>
<head>
    <title>結果</title>
</head>
<body>
    <h1>入力されたテキストは以下の通りです:</h1>
    <?php
    if (isset($_GET["input_text"])) {
        $input_text = $_GET["input_text"];
        echo "<p>" . $input_text . "</p>";
    }
    ?>
    <a href="index.html">戻る</a>
</body>
</html>

