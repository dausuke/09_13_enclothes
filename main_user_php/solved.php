<?php
session_start();
ini_set( 'display_errors', 1 );
// var_dump($_POST);
// exit();
$question_id = $_POST['question_id'];

// DB接続の設定
include('../functions.php');
$pdo = connect_to_db();

$edit_sql = 'UPDATE question SET solved=1 WHERE id=:id';
$edit_stmt = $pdo->prepare($edit_sql);
$edit_stmt->bindValue(':id', $question_id, PDO::PARAM_STR);
$edit_status = $edit_stmt->execute();
