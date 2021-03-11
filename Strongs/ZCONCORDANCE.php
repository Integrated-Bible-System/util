<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>INSERT ZCONCORDANCE</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php
$dsn='mysql:host=localhost;dbname=BibleDictionary;charset=utf8'
$user='bibleadmin';
$pw='uqEd2fmLk4QvXfX9';
try {
  // DBへ接続
  $pdo = new PDO($dsn, $user, $pw);
  // Static Place Holderを利用する
  $pdo-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // エラー発生時には例外を投げる
  $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // トランザクション終了時のAUTO COMMITを停止
  $pdo-> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
  // Static Place Holderを作成
  $stmt = $dbh->prepare("INSERT INTO ZCONCORDANCE(Z_PK, Z_ENT, Z_OPT, ZOCCURANCES, ZDICTIONARY, ZVERSE, ZENGLISH_WORD) VALUES (:pk, :ent, :opt, :occur, :dic, :verse, :eng)");
  // トランザクション開始
  $fp = fopen('ZCONCORDANCE.csv', 'r');
  $pdo->beginTransaction();
  try {
    // ファイルから1行ずつ取得して処理
    while(($csv = fgetcsv($fp)) !== FALSE) {
      $stmt->bindParam(':pk', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':ent', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':opt', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':occur', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':dic', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':verse', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':eng', $csv[0], PDO::PARAM_STR);
      $stmt->execute();
      $pdo->commit();
    }
  } catch (PDOException $e) {
    // ロールバック
    $pdo->rollback();
    throw $e;
  }
} catch (PDOException $e) {
  $errArray = $stmt->errorInfo();
  $errmsg = 'PDOException is ' . $e->getMessage() . ' and MySQL driver says "' . $errArray[2] . '"';
  exit('Database error occured!', $errmsg);
}
?>
</body>

</html>
