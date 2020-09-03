
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
       if(isset($_POST['couponCode'])){
         $couponCode = $_POST['couponCode'];
       }
       else{
         //エラー
         $couponCode= "";
       }
       ?>
       <?php
        $price = 19800;
       ?>

<DOCTYPE html>
  <!--クーポンコードを入力するフォーム-->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>クーポンコード入力ページ</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <div class="part-title">購入する商品</div>
    <div class="item">
      <div class="item-pic"><img src="./img/clock.jpg" alt="商品画像"></div>
      <div class="item-company">SEIGO(セイゴ―)</div>
      <div class="item-title">[SEIGO] 腕時計 アメダス Eco-Drive エコ・ドライブGPS衛星電波時計 ruralblog限定モデル</div>
      <div class="item-price"><?php echo number_format($price);?>円</div>
    </div>

    <div class="part-title">クーポンコードを使用する</div>

    <div class="coupon">
      ※本来は表示されていない。
      <ul>
        <li>5Q32i : 20%OFF</li>
        <li>gA22a : 15%OFF</li>
        <li>k0ja2 : 10%OFF</li>
        <li>gjl4a : 5%OFF</li>
        <li>gr1m9 : 5%OFF</li>
      </ul>
    </div>

       <!--入力フォームの作成-->

      <form class="orderbox" method="POST" action="prebuy.php">
        <!--隠しフィールドにクーポンコードと商品IDを設定してPOSTする-->
        <div class="coupon-title">使用するクーポンコード</div>
        <div>以下に使用するクーポンコードを入力してください。</div>
            <input type="text" name="couponCode" value="<?php echo $couponCode;?>">
          <hr>
            <input type="hidden" name="price" value="<?php echo $price;?>">
            <input type="submit" value="クーポンを使用する"style="background-color:#FFFF99;">
    </form>
  </body>

  </html>
