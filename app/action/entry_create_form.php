<?php


print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>新規投稿</title>
  <link href="$blog->asset/css/entry_create.css" rel="stylesheet">
  <link href="$blog->asset/css/tab.css" rel="stylesheet">
  <script src="$blog->asset/js/tab.js" type="module"></script>
</head>
<body>



<form class="tab" action="$blog->home?action=entry_create" method="POST">

<ul>
  <li class="tab-selected">新規投稿</li>
  <li>プレビュー</li>
  <li>設定</li>
</ul>

<section id="tab-section-form" class="tab-selected">
    <div class="formline"><label>タイトル</label><input type="text" name="title" autocomplete="off"></div>
    <div class="formline"><label>カテゴリ</label><input type="text" name="category" autocomplete="off"></div>
    <textarea name="body" spellcheck="false"></textarea>
</section>

<section id="tab-section-preview">
  <iframe src="$blog->asset/preview.html" width="980" height="0" frameborder="0" scrolling="no"></iframe>
</section>

<section id="tab-section-setting">
  <table>
  <tr>
    <th>記事の公開</th>
    <td><select name="status"><option value="公開" selected>公開する</option><option value="非公開">非公開にする</option></select></td>
  </tr>
  </table>
</section>

<input type="submit" value="投稿する">
</form>



</body>
</html>
END;