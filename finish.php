
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
       ?>

<DOCTYPE html>
  <!--クーポンコードと商品IDを入力するフォーム-->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>クーポンコード＆商品ID入力ページ</title>
    <link rel="stylesheet" type="text/css" href="prebuy.css">
  </head>

  <body>
    <div class="part-title">決済内容の確認</div>

       <!--入力フォームの作成-->
       <div class="orderBox">
      <form method="POST" action="index.php">
        <!--隠しフィールドにクーポンコードと商品IDを設定してPOSTする-->
        <input type="hidden" name="couponCode" value="<?php echo $couponCode; ?>">
          <div class="coupon-title">決済内容</div>
          価格 : <span class ="item-price"><?php echo number_format($price);?>円</span>
          <hr>
          <div class="buy-msg"><?php echo date("Y/m/d(D)", mktime(0,0,0,date('n'),date('j')+5,date('Y')));?>までに配送致します。</div>

          <div id ="orderBotton"><input type="submit" value="トップページに戻る"style="background-color:#FFFF99;"></div>
      </form>
    </div>
  </body>

  </html>
