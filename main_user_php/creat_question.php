<?php
session_start();
ini_set( 'display_errors', 1 );
// var_dump($_POST);
// exit()
$title = $_POST['question-title'];
$uid = $_POST['uid'];
$contents = $_POST['question-contents'];

// DB接続の設定
include('../functions.php');
$pdo = connect_to_db();

$sql = 'INSERT INTO question(id,uid,title,contents,answers,solved,created_at)VALUES(NULL,:uid,:title,:contents,0,0,sysdate())';
$stmt = $pdo->prepare($sql);
//バインド変数設定
$stmt->bindValue(':uid', $uid, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
//SQL実行
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示
    exit('sqlError:' . $error[2]);
} else {
    // 登録ページへ移動
    header('Location:user.php');
}