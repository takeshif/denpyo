<?php
  echo $_POST['omise_cd'];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>工事伝票入力</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <h1>工事代入力</h1>
    <form method="post" action="" id="new_denpyo_form">
      <div>
      <label for="tanto" class="lbl">担当者：</label>
      <input type="text" name="tanto" id="tanto" placeholder="担当者">
     </div>
     <div>
       <label for="ymd" class="lbl">伝票日付：</label>
       <input type="text" name="ymd" id="ymd" placeholder="伝票日付">
      </div>
      <div id="head1">
        <label for="omise_cd" class="lbl">お店コード：</label>
        <input type="text" name="omise_cd" id="omise_cd" maxlength="5" placeholder="お店コード">
        <span id="omise_name">エビスタ西宮</span>
        <label for="sir_cd" class="lbl">取引先コード：</label>
        <input type="text" name="sir_cd" id="sir_cd" maxlength="5" placeholder="取引先コード">
        <span id="sir_name">取引ああああああああああああ</span>
      </div>
      <div>
        <select name="item_cd">
          <option value="2000014999213">新装工事</option>
          <option value="2000014999220">新装DP</option>
          <option value="2000014999244">改装前撤去工事</option>
          <option value="2000014999251">改装工事</option>
          <option value="200001499968">改装DP</option>
          <option value="2000014999299">退店工事</option>
          <option value="2000014999237">防犯カメラ先行工事</option>
        </select>
      </div>
      <div class="meisai">
        <label for="jyodai" class="lbl">上代：</label>
        <input type="text" id="jyodai" maxlenth="6" placeholder="上代単価">
        <label for="gedai" class="lbl">下代：</label>
        <input type="text" id="gedai" maxlenth="6" placeholder="下代単価">
        <label for="siire" class="lbl">仕入：</label>
        <input type="text" id="siire" maxlenth="6" placeholder="仕入単価">

      </div>
      <span class="lease">
        <input type="radio" name="option" value="リース利用しない" checked>リース利用しない
        <input type="radio" name="option" value="リース利用する" checked>リース利用する
      </span>
      <div>
        <button type="submit" name="headgo" id="headergo" value="headergo">登録</button>
      </div>
    </form>
    <hr>
    <div class="denpyo">
      <ul>
        <li id="denpyo_1" data_id="denpyo_1">
          <span class="komoku">担当者</span>
          <span class="komoku">伝票日付</span>
          <span class="komoku">お店コード</span>
          <span class="komoku">お店名</span>
          <span class="komoku">取引先コード</span>
          <span class="komoku">取引先名</span>
          <span class="komoku">商品コード</span>
          <span class="komoku">商品名</span>
          <span class="komoku">上代</span>
          <span class="komoku">下代</span>
          <span class="komoku">仕入</span>
          <span class="komoku">リース利用しない</span>
          <span class="hensyu">編集</span>
          <span class="delete">x</span>
        </li>
        <li id="denpyo_2" data_id="denpyo_2">
          <span class="komoku">担当者</span>
          <span class="komoku">伝票日付</span>
          <span class="komoku">お店コード</span>
          <span class="komoku">お店名</span>
          <span class="komoku">取引先コード</span>
          <span class="komoku">取引先名</span>
          <span class="komoku">商品コード</span>
          <span class="komoku">商品名</span>
          <span class="komoku">上代</span>
          <span class="komoku">下代</span>
          <span class="komoku">仕入</span>
          <span class="komoku">リース利用しない</span>
          <span class="hensyu">編集</span>
          <span class="delete">x</span>
        </li>

        </ul>
      </div>
      <div>
        <button type="submit" name="go" id="go" value="go">伝票依頼書発行</button>
      </div>
  </body>
  </html>
