<?php

$blog->login_check();

print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>新規投稿</title>
  <link href="$blog->asset/css/entry_create_form.css" rel="stylesheet">
  <link href="$blog->asset/css/tab.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="$blog->asset/img/favicon.png">
  <script src="$blog->asset/js/tab.js" type="module"></script>
  <script src="$blog->asset/js/upload.js" type="module"></script>
  <script src="$blog->asset/js/preview.js" type="module"></script>
</head>
<body>



<form class="tab" action="$blog->home?action=entry_create" method="POST">
<input type="submit" value="投稿する">

<ul>
  <li class="tab-selected">新規投稿</li>
  <li>プレビュー</li>
  <li>設定</li>
</ul>

<section id="tab-content-editor" class="tab-selected">
  <div><label>タイトル</label><input type="text" name="title" required autofocus></div>
  <div><label>カテゴリ</label><input type="text" name="category"></div>
  <textarea name="body" data-upload="?action=upload" spellcheck="false" required></textarea>
  <input type="hidden" name="id">
</section>

<section id="tab-content-preview">
  <iframe src="$blog->asset/preview.html" frameborder="0"></iframe>
</section>

<section id="tab-content-setting">
  <table>
  <tr>
    <th>記事の公開</th>
    <td><select name="status" required><option value="open" selected>公開する</option><option value="close">非公開にする</option></select></td>
  </tr>
  </table>
</section>


</form>


</body>
</html>
END;