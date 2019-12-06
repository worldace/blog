<?php

$blog->login_check();

print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>新規投稿</title>
  <link rel="stylesheet" href="$blog->asset/css/entry_create_form.css">
  <link rel="stylesheet" href="$blog->asset/css/tab.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
  <script src="$blog->asset/js/tab.js" type="module"></script>
  <script src="$blog->asset/js/upload.js" type="module"></script>
  <script src="$blog->asset/js/preview.js" type="module"></script>
  <script src="$blog->asset/js/eyecatch.js" type="module"></script>
</head>
<body>



<form class="tab" action="$blog->home?action=entry_create" method="POST">

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
  <input type="hidden" name="eyecatch">
</section>

<section id="tab-content-preview">
  <iframe src="$blog->asset/preview.html"></iframe>
</section>

<section id="tab-content-setting">
  <table>
  <tr>
    <th>記事の公開</th>
    <td>
      <select name="status" required>
        <option value="open" selected>公開する</option>
        <option value="close">非公開にする</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>アップロード</th>
    <td>png jpeg jpg gifファイルに対応 <a href="?action=upload_yearly" target="_blank"><img src="$blog->asset/img/date.png" width="16" height="16" title="アップロードリスト"></a></td>
  </tr>
  </table>
</section>


<input type="submit" value="投稿する">

</form>


</body>
</html>
END;