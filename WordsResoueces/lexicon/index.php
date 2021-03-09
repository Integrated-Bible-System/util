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
    <!-- Override by my own -->
    <link rel="stylesheet" href="css/style.css">
    <!-- My Own FontAwesome Pro-->
    <script src="https://kit.fontawesome.com/223cc2ea20.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-100">
                <h1>Modify lexicons JSON files</h1>
            </div>
        </div>
        <div class="row">
            <div class="column column-80 column-center">
                <?php
                $cwd = getcwd();
                ?>
                <h2>本アプリ実行PATH</h2>
                <span><?php echo($cwd);?></span>
                <?php
                $targets = array();
                $tagetDirs = array();
                $files = scandir($cwd);
                foreach ($files as $val) {
                    if ($val !== '.' && $val !== '..' && is_dir($val) && $val !== 'css') {
                        array_push($targets, $val);
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="column column-70 column-center">
                <?php
                $files = [];
                $joinedJsonArray = [];
                $csv = [];
                foreach ($targets as $tgt) {
                    clearstatcache();
                    $tgtDir = $cwd . '/' . $tgt;
                    if ($handle = opendir($tgtDir)) {
                        $tgtArray = array();
                        while (false !== ($entry = readdir($handle))) {
                            if (!is_dir($tgt . '/' . $entry)) {
                                array_push($tgtArray, $entry);
                            }
                        }
                        $files[$tgt] = $tgtArray;
                    }
                    asort($files[$tgt], SORT_NUMERIC);
                }
                foreach ($files as $key => $ary) {
                    foreach ($ary as $file) {
                        $tgtFile = $cwd . '/' . $key . '/' . $file;
                        $path_parts = pathinfo($tgtFile);
                        $process_file = $path_parts['filename'];
                        echo('<h4>Processing ' . $process_file . '</h4>');
                        $contents = file_get_contents($tgtFile);
                        $json = mb_convert_encoding($contents, 'UTF8');
                        $jsonarr = json_decode($json, true);
                        $outfile_fullpath = $path_parts['dirname'] . '/csv/' . $path_parts['filename'] . '.csv';
                        //$fp = fopen($outfile_fullpath, 'w');
                        $line = "";
                        foreach ($jsonarr as $jkey => $jval) {
                            //var_dump($jval);
                            //echo('<hr><br>');
                            foreach ($jval as $ikey => $ival) {
                                //$line = ""
                                //var_dump($line);
                                //echo('<br>');
                            }
                            //fputcsv($fp, $line, ',', '"', "\\");
                            $line = "";
                        }
                        //fclose($fp);
                        //$outfilename = $path_parts['filename'] . '.csv';
                        //echo('<p>File ' . $outfilename . ' was created</p>');
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="column column-80 column-center">
                <?php
                echo('<h2>Finished!</h2>');
                ?>
            </div>
        </div>
    </div>
</body>

</html>