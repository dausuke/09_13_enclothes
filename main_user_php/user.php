<?php
session_start();
ini_set( 'error_reporting', E_ALL );
include("../functions.php");
check_session_id();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ユーザーページ</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <header>
        <div class="header-content">
            <p>enclothes</p>
            <div class="action">
                <div class="signout" id="signout"><i class="fas fa-sign-out-alt"></i>ログアウト</div>
            </div>
            <div class="check-answer">
                <div class="jump-answers">回答を見る</div>
            </div>
        </div>

    </header>
    <div class="title"><h1>ようこそ<?=$name?>さん</h1></div>
    <div class="question-area">
        <form class="questionform" action="signin_act.php" method="POST">
            <fieldset class="signin-content">
                <div class="form-group">
                    <input type="text" name="question-title" class="form-control" placeholder="相談のタイトルを１０文字以上１００文字未満で記入してください" >
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="question-contents" cols="50" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button class="send-question form-control"><i class="fas fa-edit"></i>相談する</button>
                </div>
            </fieldset>
        </form>
    </div>
    <script>
        //ログアウト
        $('#signout').on('click',function(){
            window.location.href = "../signout.php";
        })
        $('#question').on('click',function(){
            window.location.href = "creat_question.php";
        })
    </script>
</body>
</html>