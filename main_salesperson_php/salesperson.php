<?php
session_start();
ini_set('display_errors', 1);

include("../functions.php");
check_session_id();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM question';    //全質問取得
$newquestion_sql ='SELECT * FROM question WHERE solved=0  ORDER BY created_at DESC LIMIT 5';   //新着の質問５件取得

// SQL準備&実行
//全質問
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//新着質問
$newquestion_stmt = $pdo->prepare($newquestion_sql);
$newquestion_status = $newquestion_stmt->execute();

// データ登録処理後(全質問)
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    //未回答、回答済み、解決済みの相談の配列を作成
    $answersArray = [];
    $solvedArray = [];
    $questionArray = [];

    foreach($result as  $value){
        //未回答
        if($value['answers'] == 0){
            $questionArray[] = $value;
        }
        //未解決
        if($value['solved'] == 0){
            $answersArray[] = $value;
        }
        //解決済み
        if($value['solved'] == 1){
            $solvedArray[] = $value;
        }
    }
    // var_dump($questionArray);
    // var_dump($answersArray);
    // var_dump($solvedArray);
    // exit();
}
// データ登録処理後(新着質問)
if($newquestion_status == false){
    $error = $newquestion_stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}else{
    $newquestion_result = $newquestion_stmt->fetchAll(PDO::FETCH_ASSOC);
}

//新着、未回答、未解決、解決済の蘭に出力
//未回答
$output_question = "";
foreach ($questionArray as $key => $question_record) {
    $output_question .= "<li class='question-Area'>";
    $output_question .= "<div class='question-stateArea'>
                            <p class='question-state'>受付中</p>
                            <dl>
                                <dt>回答</dt>
                                <dd>{$question_record['answers']}</dd>
                            </dl>
                        </div>
                        <div class='question-contentArea'>
                            <div class='question-title'>
                                <a href=questions.php?id={$question_record["id"]}>{$question_record["title"]}</a>
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

//未解決
$output_answers = "";
foreach ($answersArray as $key => $answers_record) {
    $output_answers .= "<li class='question-Area'>";
    $output_answers .= "<div class='question-stateArea'>
                            <p class='question-state'>受付中</p>
                            <dl>
                                <dt>回答</dt>
                                <dd>{$answers_record['answers']}</dd>
                            </dl>
                        </div>
                        <div class='question-contentArea'>
                            <div class='question-title'>
                                <a href=questions.php?id={$answers_record["id"]}>{$answers_record["title"]}</a>
                            </div>
                            <div class='question-content'>
                                {$answers_record["contents"]}
                            </div>
                        </div>
                        <div class='question-date'>
                            <p>{$answers_record['created_at']}</p>
                        </div>";

    $output_answers .= "</li>";
}

//解決済み
$output_solved = "";
foreach ($solvedArray as $key => $solved_record) {
    $output_solved .= "<li class='question-Area'>";
    $output_solved .= "<div class='question-stateArea'>
                            <p class='question-state'>解決済み</p>
                            <dl>
                                <dt>回答</dt>
                                <dd>{$solved_record['answers']}</dd>
                            </dl>
                        </div>
                        <div class='question-contentArea'>
                            <div class='question-title'>
                                <a href=questions.php?id={$solved_record["id"]}>{$solved_record["title"]}</a>
                            </div>
                            <div class='question-content'>
                                {$solved_record["contents"]}
                            </div>
                        </div>
                        <div class='question-date'>
                            <p>{$solved_record['created_at']}</p>
                        </div>";

    $output_solved .= "</li>";
}

//新着
$output_newquestion = "";
foreach ($newquestion_result as $key => $newquestion_record) {
    $output_newquestion .= "<li class='question-Area'>";
    $output_newquestion .= "<div class='question-stateArea'>
                            <p class='question-state'>受付中</p>
                            <dl>
                                <dt>回答</dt>
                                <dd>{$newquestion_record['answers']}</dd>
                            </dl>
                        </div>
                        <div class='question-contentArea'>
                            <div class='question-title'>
                                <a href=questions.php?id={$newquestion_record["id"]}>{$newquestion_record["title"]}</a>
                            </div>
                            <div class='question-content'>
                                {$newquestion_record["contents"]}
                            </div>
                        </div>
                        <div class='question-date'>
                            <p>{$newquestion_record['created_at']}</p>
                        </div>";

    $output_newquestion .= "</li>";
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
    <title>販売員ページ</title>
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
    <main class="question">
        <nav class="navbar navbar-expand-sm navbar-light" style="background-color:white;">
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item active " >
                        新着
                    </li>
                    <li class="nav-item " >
                        未回答
                    </li>
                    <li class="nav-item " >
                        未解決
                    </li>
                    <li class="nav-item " >
                        解決済
                    </li>
                </ul>
            </div>
            <button type="button" class="btn btn-default navbar-btn">
                <span class="glyphicon glyphicon-envelope"></span>
            </button>
        </nav>
        <div class="answer-area">
            <div class="answer-content active" id="newquestion">
                <ul>
                    <?=$output_newquestion?>
                </ul>
            </div>
            <div class="answer-content" id="unanswered">
                <ul>
                    <?=$output_question?>
                </ul>
            </div>
            <div class="answer-content" id="unsolved">
                <ul>
                    <?=$output_answers?>
                </ul>
            </div>
            <div class="answer-content" id="solved">
                <ul>
                    <?=$output_solved?>
                </ul>
            </div>
        </div>
    </main>

</body>
    <script>
        //画面の切り替え
        let tabs = $(".nav-item");
        $('.nav-item').on('click', function () {
            $(".active").removeClass("active");
            $(this).addClass("active");
            const index = tabs.index(this);     //クリックされたタブが何番目か判別し変数indexに格納
            $(".answer-content").removeClass("active").eq(index).addClass("active");
        });
    </script>
</html>