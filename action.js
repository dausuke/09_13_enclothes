$(function () {
    //ログアウト
    $('#signout').on('click', function () {
        window.location.href = '../signout.php';
    });
    //ホーム画面
    $('#home').on('click', function(){
        window.location.href = '../index.php';
    })
});
