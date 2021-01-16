<?php
session_start();
ini_set( 'display_errors', 1 );

include('../functions.php');
check_session_id();

$pdo = connect_to_db();

$uid = $_SESSION['uid'];
// var_dump($questionId);
// exit();
$pdo = connect_to_db();

// データ取得SQL作成
$question_sql = 'SELECT * FROM question WHERE uid=:uid';
// SQL準備&実行
$question_stmt = $pdo->prepare($question_sql);
$question_stmt->bindValue(':uid', $uid, PDO::PARAM_STR);

$question_status = $question_stmt->execute();

// データ登録処理後
if ($question_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $question_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $question_result = $question_stmt->fetchAll(PDO::FETCH_ASSOC);
    $output_question = "";
    foreach ($question_result as $key => $question_record) {
        $output_question .= "<li class='question-Area'>";
        $output_question .= "<div class='question-stateArea'>
                                <dl>
                                    <dt>回答</dt>
                                    <dd>{$question_record['answers']}</dd>
                                </dl>
                            </div>
                            <div class='question-contentArea'>
                                <div class='question-title'>
                                    <a href=answers.php?id={$question_record["id"]}>{$question_record["title"]}</a>
                                </div>
                                <div class='question-content'>
                                    {$question_record["contents"]}
                                </div>
                            </div>
                            <div class='question-date'>
                                <p>{$question_record['created_at']}</p>
                            </div>";

        $output_question .= "</li>";
    }

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>質問一覧ページ</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../action.js"></script>
    <header>
        <div class="header-content">
            <p>enclothes</p>
            <div class="action">
                <div class="signout" id="signout"><i class="fas fa-sign-out-alt"></i>ログアウト</div>
            </div>
        </div>
    </header>
    <main>
        <div class="answer-area">
            <ul>
                <?=$output_question?>
            </ul>
        </div>
    </main>
</body>
</html>