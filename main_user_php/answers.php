<?php
session_start();
ini_set( 'display_errors', 1 );

include('../functions.php');
check_session_id();

$question_id = $_GET['id'];
// var_dump($question_id);
// exit();

$pdo = connect_to_db();

//質問のデータ取得
$question_sql = 'SELECT * FROM question WHERE id=:question_id';
// SQL準備&実行
$question_stmt = $pdo->prepare($question_sql);
$question_stmt->bindValue(':question_id', $question_id, PDO::PARAM_STR);

$question_status = $question_stmt->execute();

// データ登録処理後
if ($question_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $question_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $question_result = $question_stmt->fetch(PDO::FETCH_ASSOC);
}

//回答のデータ取得
$answers_sql = 'SELECT * FROM answers WHERE question_id=:question_id';

$answers_stmt = $pdo->prepare($answers_sql);
$answers_stmt->bindValue(':question_id', $question_id, PDO::PARAM_STR);

$answers_status = $answers_stmt->execute();

if ($answers_status == false) {
    $error = $answers_stmt->errorInfo();
    // データ登録失敗次にエラーを表示
    exit('sqlError:' . $error[2]);
} else {
    $answers_result = $answers_stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($answers_result);
    // exit();
    $output_answers = "";
    foreach($answers_result as $key => $record){
        $output_answers .= "
                            <dd class='answers'>{$answers_result[$key]['answer_content']}</dd>
                            ";
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
    <title>回答閲覧ページ</title>
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
        <dl class="questions">
            <dt>
                <div class="title">
                    <?=$question_result['title']?>
                </div>
                <div class="date">
                    <p>投稿日：<?=$question_result['created_at']?></p>
                </div>
                <div class="content">
                    <?=$question_result['contents']?>
                </div>
            </dt>
            <dd class="state">
                <span><p>回答　</p><p><?=$question_result['answers']?></p><p>　件</p></span>
            </dd>
            <?=$output_answers?>
        </dl>
        <button type="button" class="solved" id="solved">解決済み</button>
    </main>
    <script>
        $('#solved').on('click',function(){
            const data = {question_id: '<?=$question_id?>'};
            $.ajax({
                //POST通信
                type: 'POST',
                url: 'solved.php',
                data:data
            }).then(
                // 通信成功時
                function (data) {
                    //相談一覧画面へ戻る
                    // console.log(data)
                    window.location.href = "questions.php";
                },
                // 通信失敗時
                function () {
                    alert('読み込み失敗');
                }
            );
        })
    </script>
</body>
</html>