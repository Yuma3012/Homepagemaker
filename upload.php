<?php

$text_input = '';

if (isset($_POST['input_text'])) {
    $text_input = $_POST['input_text'];

    // 処理が成功した場合、result.html を表示
    $template = file_get_contents('result.html');
    $text = str_replace('{TEXT}', !empty($img_path) ? $img_path : '', $template);
    echo $image;
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

            // 処理が成功した場合、result.html を表示
            $template = file_get_contents('result.html');
            $image = str_replace('{IMG_SRC}', !empty($img_path) ? $img_path : '', $template);
            echo $image;
        } else {
            // 処理が失敗した場合、upload.html を再表示
            include('upload.html');
        }
    } else {
        // 画像ファイルでない場合の処理
        // $template = file_get_contents('upload.html');
        $MSG = '画像ファイルではありません';
        // upload.html を再表示
        include('upload.html');
    }
} else {
    // $template = file_get_contents('upload.html');
    $MSG = '画像を選択してください';
    
    // 最初の画面（upload.html）を表示
    include('upload.html');
}

?>
