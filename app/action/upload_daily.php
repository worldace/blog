<?php


$blog->login_check();

$y  = request::get('y');
$m  = request::get('m');
$d  = request::get('d');
$w  = time::weekday($y, $m, $d);
$tr = '';


foreach(file::list("upload/$y/$m$d") as $v){
    $name = basename($v);
    $date = date('Y/m/d H:i', filemtime($v));
    $size = pretty::byte(filesize($v));

    $tr  .= <<<END
    <tr>
      <td>$date</td>
      <td><a href="upload/$y/$m$d/$name" target="_blank">$name</a></td>
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
  <title>アップロードリスト {$y}年{$m}月{$d}日</title>
  <link rel="stylesheet" href="$blog->asset/css/upload.css">
  <link rel="icon" type="image/png" href="$blog->asset/img/favicon.png">
</head>
<body>


<header>
  <a href="$blog->home">$blog->title</a> /
  <a href="?action=upload_yearly">アップロードリスト</a> /
  <a href="?action=upload_yearly&y=$y">{$y}年</a> /
  {$m}月{$d}日 ($w)
</header>

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
