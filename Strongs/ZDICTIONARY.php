<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>INSERT ZDICTIONARY</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <h1>Insert to ZDICTIONARY</h1>
  <div>
  <?php
$dsn = 'mysql:host=localhost;dbname=BibleDictionary;charset=utf8';
$user = 'bibleadmin';
$pw = 'uqEd2fmLk4QvXfX9';
try {
    // DBへ接続
  $pdo = new PDO($dsn, $user, $pw);
  echo('<p>DB connected</p>');
  // Static Place Holderを利用する
  $pdo-> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // エラー発生時には例外を投げる
  $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // トランザクション終了時のAUTO COMMITを停止
  $pdo-> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
  // Static Place Holderを作成
  $stmt = $pdo->prepare("INSERT INTO ZDICTIONARY(Z_PK, Z_ENT, Z_OPT, ZDICTIONARY_NUM, ZSTRONGS_NUM, ZDEFINITION, ZORIGINAL_CHARS, ZPRONOUNCED, ZWORD_NAME) VALUES (:pk, :ent, :opt, :dicn, :stn, :def, :org, :pron, :wnam)");
  // 処理状況を表示する準備
  echo('<h2>処理開始</h2>');
  // トランザクション開始
  $fp = fopen('ZDICTIONARY.csv', 'r');
  try {
    // ファイルから1行ずつ取得して処理
    while(($csv = fgetcsv($fp)) !== FALSE) {
      $pdo->beginTransaction();
      $stmt->bindParam(':pk', $csv[0], PDO::PARAM_INT);
      $stmt->bindParam(':ent', $csv[1], PDO::PARAM_INT);
      $stmt->bindParam(':opt', $csv[2], PDO::PARAM_INT);
      $stmt->bindParam(':dicn', $csv[3], PDO::PARAM_INT);
      $stmt->bindParam(':stn', $csv[4], PDO::PARAM_INT);
      $stmt->bindParam(':def', $csv[5], PDO::PARAM_STR);
      $stmt->bindParam(':org', $csv[6], PDO::PARAM_STR);
      $stmt->bindParam(':pron', $csv[7], PDO::PARAM_STR);
      $stmt->bindParam(':wnam', $csv[8], PDO::PARAM_STR);
      $stmt->execute();
      $pdo->commit();
      echo('<p>PK = ' . $csv[0] . '処理終了</p>');
    }
  } catch (PDOException $e) {
    // ロールバック
    $pdo->rollback();
    throw $e;
  }
} catch (PDOException $e) {
  $errArray = $stmt->errorInfo();
  $errmsg = 'PDOException is ' . $e->getMessage() . ' and MySQL driver says "' . $errArray[2] . '"';
  echo('<p>異常終了します。</p>');
  exit('Database error occured!' . $e->getMessage());
}
echo('<h2>処理終了</h2>');
?>
</div>
</body>

</html>