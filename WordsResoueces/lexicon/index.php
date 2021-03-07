<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Modify lexicons</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS Framework Milligram-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- My Own FontAwesome Pro-->
    <script src="https://kit.fontawesome.com/223cc2ea20.js" crossorigin="anonymous"></script>

</head>

<body>
    <div>
        <h1>Modify lexicons JSON files</h1>
    </div>
    <div>
        <?php
        $cwd = getcwd();
        ?>
        <h2>本アプリ実行PATH</h2>
        <p><?php echo($cwd);?></p>
        <?php
        $targets = array();
        $tagetDirs = array();
        $files = scandir($cwd);
        foreach ($files as $val) {
            if ($val !== '.' && $val !== '..' && is_dir($val)) {
                array_push($targets, $val);
            }
        }
        ?>
    </div>
    <div>
        <?php
        $files = [];
        $joinedJsonArray = [];
        $csv = [];
        foreach ($targets as $tgt) {
            $tgtDir = $cwd . '/' . $tgt;
            if ($handle = opendir($tgtDir)) {
                $tgtArray = array();
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        array_push($tgtArray, $entry);
                    }
                }
                $files[$tgt] = $tgtArray;
            }
            asort($files[$tgt], SORT_NUMERIC);
        }
        foreach ($files as $key => $ary) {
            $joinedJsonArray[$key] = [];
            $csv[$key] = '';
            foreach ($ary as $file) {
                $tgtFile = $cwd . '/' . $key . '/' . $file;
                $contents = file_get_contents($tgtFile);
                $json = mb_convert_encoding($contents, 'UTF8');
                $jsonarr = json_decode($json, true);
                $joinedJsonArray[$key] += $jsonarr;
                var_dump($jsonarr);
                echo('<br>');
                /*
                $filename = $cwd . '/' . $key . '.csv';
                $fp = fopen($filename, 'w');
                $line = array();
                foreach ($joinedJsonArray[$key] as $jkey => $jary) {
                    foreach ($jary as $ckey => $cval) {
                        $line[] = $cval;
                    }
                    fputcsv($fp, $line);
                }
                fclose($fp);
                */
            }
        }
        echo("finished");
        ?>
    </div>
</body>

</html>