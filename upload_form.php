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
<!-- <link rel="stylesheet" href="css/range.css"> -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <style>div{padding: 10px;font-size:16px;}</style> -->
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
<div class="choice sell">
  <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
  <div>
    <table rules="rows">
    <tr align="left">
      <th>商品名</th>
      <td><input type="text" name="name" id="name_product"></td>
    </tr>
    <tr align="left">
      <th>サイズ</th>
      <td><input type="text" name="size" id="size"></td>
    </tr>
    <tr align="left">
    <th>価格</th>
      <td><input type="text" name="price" id="price_product">円</td>
    </tr>
    <tr align="left">
    <th>商品画像</th>
      <td><input name="img" type="file" accept="image/*" id="img"></td>
    </tr>
    <tr align="left">
    <th>キャプション</th>
      <td><textarea
            name="caption"
            placeholder="キャプション（140文字以下）"
            id="caption"
          ></textarea></td>
    </tr>
    <tr>
      <th align="left">-</th>
      <td align="right"><input type="submit" value="登録" class="button" /></td>
    </tr>
    </div>
  </form>
  
</div>


<!-- Main[End] -->

</body>
</html>


