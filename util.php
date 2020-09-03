<?php

//XSS対策のためのHTMLエスケープ

/*
<, >, ''などHTMLで使われるコードをフォームに入力されることで
制作者側が見せたくないような内容であったり、個人情報をユーザに
表示させてしまうのを防ぐため。
 */

function es($data){
  //$dataが配列のとき
  if(is_array($data)){
    //再帰呼出し
    return array_map(__METHOD__, $data);
  }
  else{
    //HTMLエスケープを行う
    return htmlspecialchars($data, ENT_QUOTES, 'utf-8');
  }
}

function cken(array $data){
  $result = true;
  foreach($data as $key => $value){
    if(is_array($value)){
    //含まれている値が配列のとき文字列に連結する
    $value = implode("", $value);
}

/*
各ソフトウェア（データベース、ミドルウェア、開発言語）で
取り扱っている文字コードが異なる場合、文字コードを変換する際に、
別の意味を持つ文字に変換されることがあり、結果的に
SQLインジェクションなどの脆弱性につながることがある。

 */
  if(!mb_check_encoding($value)){
    //文字エンコードが一致しないとき
    $result = faulse;
    //foreachでの査定を終わらせる
    break;
  }
}
return $result;
}
 ?>
