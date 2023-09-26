<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$_FILESの基本</title>
</head>
<script src="reload.js"></script>

<body>
    <main>
        <section class="form-container">
            <button type="button" onclick="location.href='copy/index.html'" id="load-button">遷移</button>
            <!-- （1）form タグからpost送信する -->
            <form action="" method="post" enctype="multipart/form-data" id="upload-form">
                <!-- input 属性はtype="file" と指定 -->
                <input type="file" name="upload_image" accept="image/*" required id="file-input">
                <label for="input-text">テキスト入力:</label>
                <input type="text" name="input_text" id="input-text" required>
                <!-- 送信ボタン -->
                <input type="submit" class="btn_submit" value="送信" id="submit-button">
            </form>
        </section>
        <!-- メッセージを表示している箇所 -->
        <p><?php echo isset($MSG) ? $MSG : ''; ?></p>
        <!-- 画像を表示している箇所 -->
        <img src="<?php echo isset($img_path) ? $img_path : ''; ?>" alt="">
        <section class="result" style="display: none;">
            <!-- やり直しボタン -->
            <button type="button" id="reset-button" style="display:none;">やり直し</button>
        </section>

        <section class="img-area">
        </section>

    </main>
</body>

</html>

<?php

$text_input = '';

if (isset($_POST['input_text'])) {
    $text_input = $_POST['input_text'];
}

if (!empty($_FILES)) {
    // images_after フォルダ内のすべてのファイルを削除
    $files = glob('images_after/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); // ファイルを削除
        }
    }

    // 画像ファイルかどうかを判定する
    if (exif_imagetype($_FILES['upload_image']['tmp_name'])) {
        // 画像ファイルの場合の処理
        $filename = $_FILES['upload_image']['name'];
        $uploaded_path = 'images_after/' . $filename;

        $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);

        if ($result) {
            // 新しい画像のパスを設定
            $img_path = $uploaded_path;
            $MSG = 'アップロード成功！ファイル名：' . $filename;
        } else {
            // 処理が失敗した場合、upload.html を再表示
            include('upload.html');
        }
    } else {
        // 画像ファイルでない場合の処理
        $MSG = '画像ファイルではありません';
        // upload.html を再表示
        include('upload.html');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($text_input); ?>のホームページ</title>
</head>

<body>
    <h1>
        <?php echo htmlspecialchars($text_input); ?>のホームページ
    </h1>
</body>

</html>
