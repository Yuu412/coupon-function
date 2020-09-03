
      <?php
      //文字エンコード検証=======================================================
      require_once("util.php");

      if(!cken($_POST)){
        $encoding = mb_check_encoding();
        $err = "Encoding Error! The expected encoding is". $encoding;
        //エラーメッセージを表示して処理を終了させる
        exit($err);
      }
      //HTMLエスケープ(XSS対策)
      $_POST = es($_POST);
      //========================================================================
       ?>

       <?php
       $price = $_POST['price'];

       //再入力のとき前回入力した値を初期値とする処理===============================
       //購入する個数に値が格納されているかどうか
       if(preg_match("/^[0-9]+$/",$_POST['kosu'])){
         $kosu = $_POST['kosu'];
       }
       else{
         $err = '<div class="error">個数を選択してください。</div>';
         exit($err);
       }
       //=======================================================================
       ?>


<DOCTYPE html>
  <!--クーポンコードと商品IDを入力するフォーム-->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>購入確認ページ</title>
    <link rel="stylesheet" type="text/css" href="prebuy.css">
  </head>

  <body>
    <div class="part-title">注文内容の確認</div>
   </div>

       <!--入力フォームの作成-->
       <div class="orderBox">
      <form method="POST" action="finish.php">
        <!--隠しフィールドにクーポンコードと商品IDを設定してPOSTする-->
          <div class="coupon-title">注文内容</div>
          価格 : <span class ="item-price"><?php echo number_format($price * $kosu);?>円</span>
          <hr>
          <input type="hidden" name="price" value="<?php echo ($price * $kosu);?>">
          <div id ="orderBotton"><input type="submit" value="注文を確定する"style="background-color:#FFFF99;"></div>
      </form>
    </div>
  </body>

  </html>
