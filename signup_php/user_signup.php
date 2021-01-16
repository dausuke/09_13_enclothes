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
            <p>enclothes</p>
            <div class="selectnav">
                <a href="salesparson_signup.php">販売員登録はこちら</a>
            </div>
        </div>
    </header>
    <main class="main-signup">
        <div class="signup-text" >
            <div class="creattitle">
                <i class="fas fa-user-plus fa-2x"></i><p>新規会員登録</p>
            </div>
            <div id="user">
                <p>アパレル販売員があなたのスタイリストとして洋服の悩みに応えます。</p>
                <p>おしゃれになりたい。</p>
                <p>自分に似合う服を見つけたい。</p>
                <p>かっこよく、かわいくなりたい。</p>
                <p>そんな願いを叶えてくれる人がきっと見つかる。</p>
            </div>
        </div>
        <div class="signup-window">
            <form action="signup_act.php" method="POST" class="signupform">
                <fieldset class="signup-content1"id="fadeout">
                    <legend>メールアドレスで登録</legend>
                    <div class="form-group signup-item">
                        <label>メールアドレス</label>
                        <input type="text" name="email" class="form-control" placeholder="メールアドレス" autocomplete="off">
                    </div>
                    <div class="form-group signup-item">
                        <label>氏名</label>
                        <input type="text" name="name" class="form-control" placeholder="氏名">
                    </div>
                    <div class="form-group signup-item">
                        <button type="button" class="form-control" id="next">次へ</button>
                    </div>
                </fieldset>
                <fieldset class="signup-content2" id="fadein">
                    <legend>プロフィール登録</legend>
                    <div class="form-group signup-item">
                        <label>年齢</label>
                        <input type="text" name="age" class="form-control" placeholder="年齢" autocomplete="off">
                    </div>
                    <div class="form-group signup-item">
                        <select type="text" name="gender" class="form-control">
                            <optgroup label="">
                                <option>性別</option>
                                <option>男性</option>
                                <option>女性</option>
                                <option>指定しない</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group signup-item">
                        <select type="text" name="city" class="form-control">
                            <optgroup label="">
                                <option>都道府県</option>
                                <option>北海道</option>
                                <option>青森</option>
                                <option>岩手</option>
                                <option>宮城</option>
                                <option>秋田</option>
                                <option>山形</option>
                                <option>福島</option>
                                <option>茨城</option>
                                <option>栃木</option>
                                <option>群馬</option>
                                <option>埼玉</option>
                                <option>千葉</option>
                                <option>東京</option>
                                <option>神奈川</option>
                                <option>新潟</option>
                                <option>富山</option>
                                <option>石川</option>
                                <option>福井</option>
                                <option>山梨</option>
                                <option>長野</option>
                                <option>岐阜</option>
                                <option>静岡</option>
                                <option>愛知</option>
                                <option>三重</option>
                                <option>滋賀</option>
                                <option>京都</option>
                                <option>大阪</option>
                                <option>兵庫</option>
                                <option>奈良</option>
                                <option>和歌山</option>
                                <option>鳥取</option>
                                <option>島根</option>
                                <option>岡山</option>
                                <option>広島</option>
                                <option>山口</option>
                                <option>徳島</option>
                                <option>香川</option>
                                <option>愛媛</option>
                                <option>高知</option>
                                <option>福岡</option>
                                <option>佐賀</option>
                                <option>長崎</option>
                                <option>熊本</option>
                                <option>大分</option>
                                <option>宮崎</option>
                                <option>鹿児島</option>
                                <option>沖縄</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group signup-item">
                        <label>よく買い物する店・ブランド</label>
                        <input type="text" name="shop" class="form-control" >
                    </div>
                    <div class="form-group signup-item">
                        <label>身長・体重</label>
                        <input type="text" name="height" class="form-control" placeholder="身長">
                        <input type="text" name="weight" class="form-control" placeholder="体重">
                    </div>
                    <div class="form-group signup-item">
                        <label>パスワード</label>
                        <input type="password" name="password" class="form-control" >
                    </div>
                    <div class="form-group signup-item">
                        <input type="hidden" class="form-control" name="attribute" value="0">
                        <button type="submit" class="form-control">送信</button>
                    </div>
                </fieldset>
            </form>
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
        $('#next').on('click',function(){
            $('#fadeout').fadeOut();
            $('#fadein').fadeIn();
        })
        //年齢入力画面は半角表示
        $('#age').on('input', function(e) {
            let value = $(e.currentTarget).val();
            value = value
                .replace(/[０-９]/g, function(s) {
                    return String.fromCharCode(s.charCodeAt(0) - 65248);
                })
                .replace(/[^0-9]/g, '');
            $(e.currentTarget).val(value);
        });
    </script>
</body>
</html>