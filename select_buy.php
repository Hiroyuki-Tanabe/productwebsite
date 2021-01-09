<?php
// 書くと、中の変数が使えるようになる
require_once('funcs.php');

$choice = $_GET["choice_price"];

if ($choice == 'new') {
    $sql = "SELECT * FROM kadai ORDER BY id DESC";
} elseif ($choice == 'reasonable') {
    $sql = "SELECT * FROM kadai ORDER BY price";
} elseif ($choice == 'expensive') {
    $sql = "SELECT * FROM kadai ORDER BY price DESC";
} else {
    $sql = "SELECT * FROM kadai ORDER BY id DESC";
}

//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=kadai;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    // FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class="product">
                    <form action="./select_detail.php" method="get">
                      <button type="submit" name="id" value='. h($result['id']) . '><img src="' . h($result['file_path']) . '" alt="" class="image"></button>
                    </form>
                      <div id="content">
                        <div id="name">'.h($result['name']).'</div>
                        <div id="size">'.h($result['size']).'サイズ</div>
                        <div id="price">¥'.h($result['price']).'</div>
                      </div>              
                  </div>';
    }

}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link href="css/reset.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>

<body>
<!-- Head[Start] -->
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

<!-- Head[End] -->

<!-- Main[Start] -->
<div class="choice buy">
  <div id="table">
    <form action="#" method="get">
      <select name="choice_price" id="choice_price" onchange="submit(this.form)">
        <option value="new" 
          <?php echo array_key_exists('choice_price', $_GET) && $_GET['choice_price'] == 'new' ? 'selected' : ''; ?>>新着順
        </option>
        <option value="reasonable"
          <?php echo array_key_exists('choice_price', $_GET) && $_GET['choice_price'] == 'reasonable' ? 'selected' : ''; ?>>価格の安い順
        </option>
        <option value="expensive"
        <?php echo array_key_exists('choice_price', $_GET) && $_GET['choice_price'] == 'expensive' ? 'selected' : ''; ?>>価格の高い順</option>
      </select>
    </form>
  </div>
</div>

<div class="container"><?= $view; ?></div>

<section id="modalArea" class="modalArea">
  <div id="modalBg" class="modalBg"></div>
  <div class="modalWrapper">
    <div class="modalContents">
      <h1>Here are modal contents!</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
    </div>
    <div id="closeModal" class="closeModal">
      
    </div>
  </div>
</section>


<?php

// function show() {
//   $data = filter_input(INPUT_GET, 'id');
//   var_dump($data);
// }

function show()
{
    echo "おはよう";
}
// show();

?>

<!-- Main[End] -->

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="./js/kadai.js"></script> -->

</body>
</html>




