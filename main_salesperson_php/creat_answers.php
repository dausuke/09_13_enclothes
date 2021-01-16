<?php
session_start();
ini_set( 'display_errors', 1 );

$question_id = $_POST['question_id'];
$salesperson_id = $_POST['salesperson_id'];
$questionuser = $_POST['questionuser'];
// var_dump($questionuser);
// exit();
$question_ontents = $_POST['question_ontents'];
// DB接続の設定
include('../functions.php');
$pdo = connect_to_db();

$sql = 'INSERT INTO answers(id,question_id,salesperson_id,uid,answer_content,created_at)VALUES(NULL,:question_id,:salesperson_id,:uid,:answer_content,sysdate())';
$stmt = $pdo->prepare($sql);
//バインド変数設定
$stmt->bindValue(':question_id', $question_id, PDO::PARAM_STR);
$stmt->bindValue(':salesperson_id', $salesperson_id, PDO::PARAM_STR);
$stmt->bindValue(':uid', $questionuser, PDO::PARAM_STR);
$stmt->bindValue(':answer_content', $question_ontents, PDO::PARAM_STR);

//SQL実行
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示
    exit('sqlError:' . $error[2]);
} else {

    //questionテーブルのanswersカラムを編集
    $answer_sql = 'SELECT answers FROM question WHERE id=:id';
    // SQL準備&実行
    $answer_stmt = $pdo->prepare($answer_sql);
    $answer_stmt->bindValue(':id', $question_id, PDO::PARAM_STR);
    $answer_status = $answer_stmt->execute();

    // データ登録処理後
    if ($answer_status == false) {
        // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
        $error = $answer_stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        $result = $answer_stmt->fetch(PDO::FETCH_ASSOC);
        //編集用の変数作成
        $answer_count = (int)$result["answers"];
        $answer_count += 1;
        //編集実行
        $edit_sql = 'UPDATE question SET answers=:answer_count WHERE id=:id';
        $edit_stmt = $pdo->prepare($edit_sql);
        $edit_stmt->bindValue(':answer_count', $answer_count, PDO::PARAM_INT);
        $edit_stmt->bindValue(':id', $question_id, PDO::PARAM_STR);
        $edit_status = $edit_stmt->execute();

        // データ編集処理後
        if ($edit_status == false) {
        // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
        $error = $edit_stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
        }else{
            //販売員ページへ移動
            header('Location:salesperson.php');
        }
    }
}