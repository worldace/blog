<?php

$blog->login_check();

$y    = request::get('y', date('Y'));
$dir  = is_dir("upload/$y") ? dir::list("upload/$y") : [];
$prev = $y-1;
$next = ($y < date('Y')) ? $y+1 : '';


$tr = html::tr(12, 31, function($m, $d) use($y, $dir){
    $m++;
    $d++;
    $mm = sprintf('%02d', $m);
    $dd = sprintf('%02d', $d);
    $w  = time::weekday($y, $m, $d);

    if(isset($dir["$mm$dd/"])){
        return "<td class='$w'><a href='?action=upload_daily&y=$y&m=$mm&d=$dd'>{$mm}月{$dd}日</a></td>\n";
    }
    else if(!checkdate($m, $d, $y)){
        return "<td>-</td>\n";
    }
    else{
        return "<td class='$w'>{$mm}月{$dd}日</td>\n";
    }
});



print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>アップロードリスト {$y}年</title>
  <link rel="stylesheet" href="$blog->asset/css/upload.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>


<header>
  <a href="$blog->home">$blog->title</a> /
  <a href="?action=upload_yearly">アップロードリスト</a> /
  {$y}年
</header>

<nav><a href="?action=upload_yearly&y=$prev">←</a> {$y}年 <a href="?action=upload_yearly&y=$next">→</a></nav>

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