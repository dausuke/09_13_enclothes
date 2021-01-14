<?php
session_start();

include("../functions.php");
check_session_id();

$uid = $_SESSION['uid'];
$name = $_SESSION['name'];

// var_dump($name);
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
    <script src="main.js"></script>
    <header>
        <div class="header-content">
            <p>enclothes</p>
            <div class="action">
                <div class="signout" id="signout"><i class="fas fa-sign-out-alt"></i>ログアウト</div>
            </div>
        </div>
    </header>
    <div class="title"><h1>ようこそ<?=$name?>さん</h1></div>
    <div class="question">
        <nav class="navbar navbar-expand-sm navbar-light" style="background-color:white;">
            <div class="navbar-collapse justify-content-center">
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
                新着
            </div>
            <div class="answer-content" id="unanswered">
                未回答
            </div>
            <div class="answer-content" id="unsolved">
                未解決
            </div>
            <div class="answer-content" id="solved">
                解決済
            </div>
        </div>
    </div>

</body>
    <script>
        //ログアウト
        $('#signout').on('click',function(){
            window.location.href = "signout.php";
        })
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