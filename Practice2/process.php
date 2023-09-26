<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_text = $_POST["input_text"];
    
    // ここでデータベースに保存するか、その他の処理を行うことができます

    // リダイレクト
    header("Location: result.php?input_text=" . urlencode($input_text));
    exit();
}
?>
