<?php

  session_start();

  require_once(__DIR__ . '/config.php');
  require_once(__DIR__ . '/function.php');
  require_once(__DIR__ . '/Denpyo.php');

  $denpyoApp = new \MyApp\Denpyo();
  $denpyoes = $denpyoApp->getAll();

  if ($_POST['headgo'] === 'headergo') {
    // echo "ヘッダー登録を押しました";
    // $denpyoApp = new \MyApp\Denpyo();
    // $denpyoes = $denpyoApp->getAll();
  } elseif ($_POST['go'] === 'go') {
    // echo "伝票発行を押しました";
  }
  // echo $_POST['omise_cd'];

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
      <select name="mode" id="mode">
        <option value="toroku">新規登録</option>
        <option value="syusei">修正</option>
      </select>
      </div>
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
        <input type="text" name="jyodai" id="jyodai" maxlenth="6" placeholder="上代単価">
        <label for="gedai" class="lbl">下代：</label>
        <input type="text" name="gedai" id="gedai" maxlenth="6" placeholder="下代単価">
        <label for="siire" class="lbl">仕入：</label>
        <input type="text" name="siire" id="siire" maxlenth="6" placeholder="仕入単価">

      </div>
      <span class="lease">
        <input type="radio" name="option" value="リース利用しない">リース利用しない
        <input type="radio" name="option" value="リース利用する">リース利用する
      </span>
      <div>
        <!-- <button type="submit" name="headgo" id="headergo" value="headergo">登録</button> -->
        <input type="button" name="headgo" id="headergo" value="登録">
      </div>
    <!-- </form> -->
    <hr>
    <div class="denpyo">
      <ul id="denpyos">
        <?php foreach ($denpyoes as $denpyo) : ?>
        <li id="denpyo_<?= h($denpyo->id); ?>" data-id="<?= h($denpyo->id); ?>">
          <span class="komoku" id="tanto_<?= h($denpyo->id); ?>"><?= h($denpyo->tanto); ?></span>
          <span class="komoku" id="yyyymmdd_<?= h($denpyo->id); ?>"><?= h($denpyo->yyyymmdd); ?></span>
          <span class="komoku" id="omise_<?= h($denpyo->id); ?>"><?= h($denpyo->omise_cd); ?></span>
          <span class="komoku" id="omiseName_<?= h($denpyo->id); ?>"><?php $imtok = $denpyoApp->getOmiseName($denpyo->omise_cd); echo h($imtok[0]->omise_name); ?></span>
          <span class="komoku" id="sir_<?= h($denpyo->id); ?>"><?= h($denpyo->sir_cd); ?></span>
          <span class="komoku" id="sirName_<?= h($denpyo->id); ?>"><?php $imsir = $denpyoApp->getSirName($denpyo->sir_cd); echo h($imsir[0]->sir_name); ?></span>
          <span class="komoku" id="itemcd_<?= h($denpyo->id); ?>"><?= h($denpyo->item_cd); ?></span>
          <span class="komoku" id="itemName_<?= h($denpyo->id); ?>"><?php $imsho = $denpyoApp->getItemName($denpyo->item_cd); echo h($imsho[0]->item_name); ?></span>
          <span class="komoku" id="jtanka_<?= h($denpyo->id); ?>"><?= h($denpyo->jtanka); ?></span>
          <span class="komoku" id="gtanka_<?= h($denpyo->id); ?>"><?= h($denpyo->gtanka); ?></span>
          <span class="komoku" id="stanka_<?= h($denpyo->id); ?>"><?= h($denpyo->stanka); ?></span>
          <span class="komoku" id="lease_<?= h($denpyo->id); ?>">リース利用しない</span>
          <span class="hensyu">編集</span>
          <span class="delete">x</span>
        </li>
        <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <button type="submit" name="go" id="go" value="go">伝票依頼書発行</button>
      </div>
    </form>
    <input type="hidden" id="token" value="<?= h($_SESSION['token']); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="denpyo.js"></script>
  </body>
  </html>
