<?php

// ③DBへの保存
require_once "./dbc.php";

// ファイル以外の取得
$name = $_POST['name'];
$size = $_POST['size'];
$price = $_POST['price'];
// var_dump($name);

// ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$filr_err = $file['error'];
$filesize = $file['size'];
// $upload_dir = '/Applications/MAMP/htdocs/kadai02_test/test3/images';
$upload_dir = './images/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;

// キャプションを取得
$caption = filter_input(INPUT_POST, 'caption',
FILTER_SANITIZE_SPECIAL_CHARS);


var_dump($file);
echo "キャプション";
var_dump($caption);

// キャプションのバリデーション
// 未入力
if(empty($caption)) {
    array_push($err_msgs, 'キャプションを入力してください');
    echo '<br>';
// 140文字か
if(strlen($caption) > 140) {
    array_push($err_msgs, 'キャプションは140文字以内で入力してください');
    echo '<br>';
}
}
// ファイルのバリデーション
// 拡張子は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext )){
    array_push($err_msgs, '画像ファイルを添付してください');
    echo '<br>';
}

if(count($err_msgs) == 0) {
    // ファイルはあるか
    if(is_uploaded_file($tmp_path)) {
        if(move_uploaded_file($tmp_path, $save_path)) {
            echo $filename . 'を' . $upload_dir . 'にアップしました。';
            // DBに保存（ファイル名、ファイルパス、キャプション）
            $result = fileSave($name, $size, $price, $filename, $save_path, $caption);

            if ($result) {
                echo 'データベースに保存しました！';
            } else {
                echo 'データベースへの保存に失敗しました';
            }

        }else {
            echo 'ファイルが保存できませんでした';
            echo '<br>';
        }
        
    } else {
        echo 'ファイルが選択されていません。';
        echo '<br>';
    }
} else {
    foreach($err_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}


if(count($err_msgs) === 0){

}else{
    foreach($err_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}

?>

<a href = "upload_form.php">戻る</a>