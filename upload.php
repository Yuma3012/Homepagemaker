<?php

$text_input = '';
$Name_text = '';
$Rome_text = '';
$Free_text = '';
$IMG_SRC = '';
$filename = ''; // 初期化
$result = '';
if (isset($_POST['name_text']) && isset($_POST['rome_text'])) {
    $Name_text = $_POST['name_text'];
    $Rome_text = $_POST['rome_text'];

    if (isset($_POST['free_text'])) {
        $Free_text = nl2br($_POST['free_text']);
    }

    if (empty($_FILES) || !isset($_FILES['upload_image']['tmp_name']) || $_FILES['upload_image']['error'] == UPLOAD_ERR_NO_FILE) {
        // 画像がアップロードされない場合はデフォルトの画像パスを設定
        $uploaded_path = 'images/default/woody.jpg';
        $IMG_SRC = $uploaded_path; // 画像パスを設定
        $result = 'true';
        $MSG = ''; // エラーメッセージをクリア
    } else {
        // images_after フォルダ内のすべてのファイルを削除
        $files = glob('images/upload*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // ファイルを削除
            }
        }

        if (exif_imagetype($_FILES['upload_image']['tmp_name'])) {
            // 画像ファイルの場合の処理
            $filename = $_FILES['upload_image']['name'];
            $uploaded_path = 'images/upload' . $filename;

            $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);
            $IMG_SRC = $uploaded_path; // 画像パスを設定
            $MSG = ''; // エラーメッセージをクリア
        } else {
            // 画像ファイルでない場合の処理
            $MSG = '画像ではありません';
        }
    }

    if (isset($result) || $result) {
        include('result.html');
        // result.htmlを表示したら、upload.htmlを表示しないようにする
        exit; // スクリプトの実行を終了
    }
}

// upload.html を表示
include('upload.html');
?>
