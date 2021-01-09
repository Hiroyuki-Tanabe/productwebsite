<?php
// 書くと、中の変数が使えるようになる
require_once('funcs.php');

$id = $_GET['id'];

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=kadai;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//1-２．データ取得SQL作成
$sql = "SELECT * FROM kadai where id = $id";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//1-３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class="detail">
                    <img src="' . h($result['file_path']) . '" alt="" class="image_detail">
                    <div id="content" class="content_detail">
                      <div id="name">'.h($result['name']).'</div>
                      <div id="size">'.h($result['size']).'サイズ</div>
                      <div id="price">¥'.h($result['price']).'</div>
                      <div id="caption">'.h($result['description']).'</div>
                    </div>              
                  </div>';

        $mask_name = h($result['name']);
    }
}

//2-２．データ取得SQL作成
$sql2 = "SELECT * FROM review where id = $id";
$stmt2 = $pdo->prepare($sql2);
$status2 = $stmt2->execute();

//2-３．データ表示
$review="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $review .= '
                    <div id="review_id">'.h($result['review_id']).'：</div>
                    <div id="valuation">'.h($result['valuation']).'</div>
                    <div id="comment">'.h($result['comment']).'</div>';

    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

<ul>
  <a href="./select.php" id="brand">Mask gallary</a>
  <nav>
    <ul>
      <a href="./select_buy.php" class="nav_item">マスクを買う</a>
      <a href="./upload_form.php" class="nav_item">マスクを売る</a>
    </ul>
  </nav>
  <form id="form1" action="自分のサイトURL">
      <input id="sbox"  id="s" name="s" type="text" placeholder="キーワードを入力" />
      <input id="sbtn" type="submit" value="検索" />
  </form>
</ul>

<div><?= $view; ?></div>
<div id="review">
  <a>口コミ</a>
  <?= $review; ?>
</div>
<div class="back"><a href="#">>>買い物カゴにいれる</a></div>
<!-- <div class="back"><a href="./review.php">>>レビューを書く</a></div> -->
<div class="back"><a href="./select_buy.php">>>一覧に戻る</a></div>



<form action="./review.php" method="post">
  <input type="hidden" name="id" value= "<?php echo $id ?>">
  <input type="hidden" name="mask_name" value= "<?php echo $mask_name ?>">
  <input type="submit" value="レビューを書く">
</form>