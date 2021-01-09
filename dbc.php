<?php

// ①DBから全データ取得
// ②for eachで取得

function dbc()
{
    $host = "localhost";
    $dbname = "kadai";
    $user = "root";
    $pass = "root";

    $dns = "mysql:host=$host;
    dbname=$dbname;charset=utf8";

    try {
        $pdo = new PDO(
            $dns,
            $user,
            $pass,
            [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
        );
        return $pdo;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

/**
 * ファイルデータを保存
 * @param string $filename ファイル名
 * @param string $save_path 保存先のパス
 * @param string $caption 投稿の説明
 * @return bool $result
 */
function fileSave($name, $size, $price, $filename, $save_path, $caption)
{
    $result = False;

    $sql = "INSERT INTO kadai (name, size, price, file_name, file_path, description) VALUE(?, ?, ?, ?, ?, ?)";

    try{
        $stmt = dbc() ->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $size);
        $stmt->bindValue(3, $price);
        $stmt->bindValue(4, $filename);
        $stmt->bindValue(5, $save_path);
        $stmt->bindValue(6, $caption);
        $result = $stmt->execute();
        return $result;
    }catch(\Exception $e){
        echo $e->getMessage();
        return $result;
    }


}