<?php
 
//（2）$_FILEに情報があれば（formタグからpost送信されていれば）以下の処理を実行する
if(!empty($_FILES)){

// images_after フォルダ内のすべてのファイルを削除
$files = glob('images_after/*'); // フォルダ内のファイル一覧を取得
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file); // ファイルを削除
    }
} 

    //  画像ファイルかどうかを判定する
    if (exif_imagetype($_FILES['upload_image']['tmp_name'])) {
        // 画像ファイルの場合の処理
        //（3）$_FILESからファイル名を取得する
        $filename = $_FILES['upload_image']['name'];

        //（4）$_FILESから保存先を取得して、images_after（ローカルフォルダ）に移す
        //move_uploaded_file（第1引数：ファイル名,第2引数：格納後のディレクトリ/ファイル名）
        $uploaded_path = 'images_after/'.$filename;
        //echo $uploaded_path.'<br>';

        $result = move_uploaded_file($_FILES['upload_image']['tmp_name'],$uploaded_path);

        if($result){


        // 新しい画像のパスを設定
        $img_path = $uploaded_path;
        $MSG = 'アップロード成功！ファイル名：'.$filename;

        }else{
        $MSG = 'アップロード失敗！エラーコード：'.$_FILES['upload_image']['error'];
        }
    } else {
        // 画像ファイルでない場合の処理
        $MSG = '画像ファイルではありません';
    }    
    
}else{
$MSG = '画像を選択してください';
}
?>
 
 
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>$_FILESの基本</title>
</head>
<body>
 
<main>
 
<section class="form-container">
 
<!--  メッセージを表示している箇所ｙ-->
<p><?php if(!empty($MSG)) echo $MSG;?></p>
 
  <!-- 画像を表示している箇所 -->
  <?php if(!empty($img_path)){;?>
 
   <img src="<?php echo $img_path;?>" alt="">
 
  <?php } ;?>
 
 
  <!-- （1）form タグからpost送信する -->
  <form action="" method="post" enctype="multipart/form-data">
 
    <!-- input 属性はtype="file" と指定-->
    <input type="file" name="upload_image">
 
    <!-- 送信ボタン -->
    <input type="submit" calss="btn_submit" value="送信">
 
  </form>
</section>
 
<section class="img-area">
 
<?php
if(!empty($img_path)){  ?>
<!-- （5）ローカルフォルダに移動した画像を画面に表示する -->
 <img src="echo <?php $img_path;?>" alt="">
<?php
}
?>
</section>
 
</main>
 
 
</body>
</html>