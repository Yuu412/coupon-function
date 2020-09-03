<?php
//購入ページと金額計算ぺージの両方から参照するデータを格納するページ

//販売データ
$couponList = ["5Q32i" => 0.80, "gA22a "=>0.85, "k0ja2"=>0.90, "gjl4a"=>0.95, "gr1m9"=>0.95];

//クーポンコードで割引率を調べて値を返す
function getCouponRate($code){
  global $couponList;
  //該当するクーポンコードがあるかどうかチェックする
  //array_key_exist(a,b)はaがbにあるかどうかを判別する関数(TRUE or False)
$isCouponCode = array_key_exists($code, $couponList);

if($isCouponCode){
  return $couponList[$code];  //割引率を返す
}
else{
  //見つからなかったらNULLを返す
  return NULL;
}
}
 ?>
