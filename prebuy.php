
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
       if(isset($_POST['kosu'])){
         $kosu = $_POST['kosu'];
       }
       else{
         $kosu =1;
       }
       //=======================================================================
       ?>
       <?php
       //参照するページを読み込む
       require_once("data.php");
       //クーポンコードを設定する
       //ソースコードを見ても割引率が分からない仕様

       if(!preg_match('/[^A-Za-z0-9&()*#_ｶ\-ﾄﾞｹﾞﾝｷﾝ]/',$_POST['couponCode'])){
         $couponCode = $_POST['couponCode'];
         //割引率と単価を算出する
         $discount = getCouponRate($couponCode);
         //割引率と単価に値が入力されてるかどうか
         if(is_null($discount)){
           $err = '<div class="error">不正な操作がありました。</div>';
           exit($err);
         }
       }
       else{
         $discount = 1.0;
       }
       ?>

<!DOCTYPE html>
  <!--クーポンコードと商品IDを入力するフォーム-->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>商品個数入力ページ</title>
    <link rel="stylesheet" type="text/css" href="prebuy.css">
  </head>

  <body>
    <div class="part-title">購入する商品と価格の確認</div>

    <?php
    $discountRate = (1 - $discount) * 100;
    $discountRate_color = "<font color = 'red'>$discountRate%</font>";
    if($discount > 0){?>
    <div class="discount-msg">
      <?php
      echo "<h2>", $discountRate_color , "OFFの価格で購入できます。</h2>";
     } ?>
   </div>

       <!--入力フォームの作成-->
       <div class="orderBox">
      <form method="POST" action="confirm.php">
        <!--隠しフィールドにクーポンコードと商品IDを設定してPOSTする-->
        <input type="hidden" name="couponCode" value="<?php echo $couponCode; ?>">
          <div class="coupon-title">注文内容</div>
          価格 : <span class ="item-price"><?php echo number_format($price * $discount);?>円</span>
          <br>
          個数 : <input class="kosu" type ="number" name="kosu" value ="<?php echo $kosu;?>">
          <hr>
          <input type="hidden" name="price" value="<?php echo ($price*$discount);?>">
          <div id ="orderBotton"><input type="submit" value="購入手続きを進める"style="background-color:#FFFF99;"></div>
      </form>
    </div>
  </body>

  </html>
