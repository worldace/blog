<?php

$y  = request::get('y');
$m  = request::get('m');
$d  = request::get('d');
$w  = time::weekday($y, $m, $d);
$tr = '';


foreach(file::list("upload/$y/$m$d") as $v){
    $name = basename($v);
    $date = date('Y/m/d H:i', filemtime($v));
    $size = prettyByte(filesize($v));

    $tr  .= <<<END
    <tr>
      <td>$date</td>
      <td><a href="{$blog->home}upload/$y/$m$d/$name" target="_blank">$name</a></td>
      <td>$size</td>
      <td>
        <form action="?action=upload_delete" method="POST">
          <input type="hidden" name="y" value="$y">
          <input type="hidden" name="m" value="$m">
          <input type="hidden" name="d" value="$d">
          <input type="hidden" name="file" value="$name">
          <input type="submit" value="">
        </form>
      </td>
    </tr>
    END;
}


print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>アップロードリスト</title>
  <link rel="stylesheet" href="$blog->asset/css/upload.css">
</head>
<body>


<header><a href="?action=upload_yearly">アップロードリスト</a> / <a href="?action=upload_yearly&y=$y">{$y}年</a> / {$m}月{$d}日 ($w)</header>

<table id="daily">
<tr>
  <th>投稿日</th>
  <th>ファイル</th>
  <th>サイズ</th>
  <th>削除</th>
</tr>
$tr
</table>

<script>
document.addEventListener('submit', function(event){
    if(confirm('このファイルを削除しますか？') === false){
        event.preventDefault();
    }
});
</script>


</body>
</html>
END;


function prettyByte(int $byte) :string{
    if($byte >= 1073741824){
        return number_format($byte/1073741824, 2).' GB';
    }
    elseif($byte >= 1048576){
        return number_format($byte/1048576, 1).' MB';
    }
    elseif($byte >= 1024){
        return number_format($byte/1024).' KB';
    }
    elseif($byte > 1){
        return '1 KB';
    }
    else {
        return '0 KB';
    }
}
