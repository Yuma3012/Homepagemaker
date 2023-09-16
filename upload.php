<?php
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
            $MSG = 'アップロード失敗！エラーコード：' . $_FILES['upload_image']['error'];
        }
    } else {
        // 画像ファイルでない場合の処理
        $MSG = '画像ファイルではありません';
    }
} else {
    $MSG = '画像を選択してください';
}

// HTMLファイルの読み込み
$template = file_get_contents('upload.html');
$template = str_replace('{IMG_SRC}', !empty($img_path) ? $img_path : '', $template);
$template = str_replace('{MESSAGE}', !empty($MSG) ? $MSG : '', $template);

echo $template;
?>
