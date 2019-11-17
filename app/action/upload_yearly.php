<?php

$y       = request::get('y') ?? date('Y');
$dirlist = is_dir("upload/$y") ? dir::list("upload/$y") : [];
$tr      = '';

for($d = 1; $d <= 31; $d++){
    $tr .= "<tr>\n";
    for($m = 1; $m <= 12; $m++){
        $mm = sprintf('%02d', $m);
        $dd = sprintf('%02d', $d);
        $w  = time::weekday($y, $m, $d);

        if(isset($dirlist["$mm$dd/"])){
            $tr .= "<td class=\"$w\"><a href=\"?action=upload_daily&y=$y&m=$mm&d=$dd\">{$mm}月{$dd}日</a></td>\n";
        }
        else if(!checkdate($m, $d, $y)){
            $tr .= "<td>-</td>\n";
        }
        else{
            $tr .= "<td class=\"$w\">{$mm}月{$dd}日</td>\n";
        }
    }
    $tr .= "</tr>\n";
}


$prev = '';
$next = '';
if($y > $blog->upload_yearly_first){
    $prev = sprintf('<a href="?action=upload_yearly&y=%s">←</a>', $y - 1);
}
if($y < date('Y')){
    $next = sprintf('<a href="?action=upload_yearly&y=%s">→</a>', $y + 1);
}


print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>アップロードリスト {$y}年</title>
  <link rel="stylesheet" href="$blog->asset/css/upload.css">
</head>
<body>


<header><a href="?action=upload_yearly">アップロードリスト</a> / {$y}年</header>

<nav>$prev {$y}年 $next</nav>

<table id="yearly">
<tr>
  <th>1月</th>
  <th>2月</th>
  <th>3月</th>
  <th>4月</th>
  <th>5月</th>
  <th>6月</th>
  <th>7月</th>
  <th>8月</th>
  <th>9月</th>
  <th>10月</th>
  <th>11月</th>
  <th>12月</th>
</tr>
$tr
</table>

</body>
</html>
END;