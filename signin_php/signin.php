<?php

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>enclothes</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../action.js"></script>
    <header>
        <div class="header-content">
            <p id="home">enclothes</p>
            <ul class="selectnav">
                <li class="selectuser">
                    <a href="#salesperson">販売員の方はこちら</a>
                </li>
                <li class="selectuser none">
                    <a href="#user">ユーザーの方はこちら</a>
                </li>
            </ul>
        </div>
    </header>
    <main>
    <div class="content active" id="user">
        <div class="login-introducton">
            <h2><i class="fas fa-sign-in-alt"></i>ユーザーサインイン</h2>
            <h2>enclothes</h2>
            <h3>人と物の出会いで新たな価値を創造する</h3>
        </div>
        <div class="signinform">
            <form action="signin_act.php" method="POST">
                <fieldset class="signin-content">
                    <div class="signinarea form-group">
                        <input type="text" name="email" class="form-control" placeholder="メールアドレス" autocomplete="off">
                        <p class="alert">メールアドレスの形式が正しくありません</p>
                    </div>
                    <div class="signinarea form-group">
                        <input type="password" class="form-control" name="pass" placeholder="パスワード">
                        <input type="hidden" class="form-control" name="attribute" value="0">
                    </div>
                    <div class="form-group">
                        <button class="signinbtn form-control">ログイン</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="content" id="salesperson">
        <div class="login-introducton">
            <h2><i class="fas fa-sign-in-alt"></i>販売員サインイン</h2>
            <h2>enclothes</h2>
            <h3>人と物の出会いで新たな価値を創造する</h3>
        </div>
        <div class="signinform">
            <form action="signin_act.php" method="POST">
                <fieldset class="signin-content">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="メールアドレス" autocomplete="off">
                        <p class="alert">メールアドレスの形式が正しくありません</p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pass" placeholder="パスワード">
                        <input type="hidden" class="form-control" name="attribute" value="1">
                    </div>
                    <div class="form-group">
                        <button class="signinbtn form-control">ログイン</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </main>
    <script>
    //画面の切り替え
    $('.selectuser a').on('click', function () {
        $(this)
            .parent()
            .addClass('none')
            .siblings('.none')
            .removeClass('none');
        const content = $(this).attr('href');
        $(content).addClass('active').siblings('.active').removeClass('active');
        return false;
    });
    </script>
</body>
</html>