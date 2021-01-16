<?php
session_start();
ini_set('display_errors', 1);

include('../functions.php');
check_session_id();
$uid = $_SESSION['uid'];
$questionId = $_GET['id'];
// var_dump($questionId);
// exit();
$pdo = connect_to_db();

// データ取得SQL作成
$question_sql = 'SELECT * FROM question WHERE id=:id';
// SQL準備&実行
$question_stmt = $pdo->prepare($question_sql);
$question_stmt->bindValue(':id', $questionId, PDO::PARAM_STR);
$question_status = $question_stmt->execute();

// データ登録処理後
if ($question_status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $question_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $question_result = $question_stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($result);
    // exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/salesperson.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>相談詳細ページ</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../action.js"></script>
    <header>
        <div class="header-content">
            <p>enclothes</p>
            <div class="action">
                <div class="signout" id="signout"><i class="fas fa-sign-out-alt"></i>ログアウト</div>
            </div>
        </div>
    </header>
    <main >
        <dl class="question-detail">
            <dt>
                <div class="title">
                    <?=$question_result['title']?>
                </div>
                <div class="state-date">
                    <div class="state">
                        <p>回答：<?=$question_result['answers']?>件</p>
                    </div>
                    <div class="date">
                        <p>投稿日：<?=$question_result['created_at']?></p>
                    </div>
                </div>
            </dt>
            <dd>
                <?=$question_result['contents']?>
            </dd>
        </dl>
        <div class="answers-area" id="answers-area"></div>
        <button type="button" class="answes-btn" id="openAnswes_area">回答する</button>
    </main>
    <script>
        $('#openAnswes_area').on('click',function(){
            const formTag = `
                <form action="creat_answers.php" method="POST">
                    <fieldset class="answers-content">
                        <div class="form-group">
                            <textarea class="form-control" name="question_ontents" rows="15"></textarea>
                            <input type="hidden" name="salesperson_id" value="<?=$uid?>">
                            <input type="hidden" name="question_id" value="<?=$questionId?>">
                            <input type="hidden" name="questionuser" value="<?=$result['uid']?>">
                        </div>
                        <div class="form-group">
                            <button class="answes-btn form-control">回答を投稿</button>
                        </div>
                    </fieldset>
                </form>
            `;
            $('#openAnswes_area').remove();
            $('#answers-area').html(formTag);

        })
    </script>
</body>
</html>