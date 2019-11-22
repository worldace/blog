<?php

$blog->login_check();

$id = (int)request::get('id');

$entry = $db->select($id);
if($entry->category){
    $entry->category = json_decode($entry->category);
    $entry->category = implode(" ", $entry->category);
}

$json = json_encode($entry, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT);



print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>編集</title>
  <link href="$blog->asset/css/entry_create_form.css" rel="stylesheet">
  <link href="$blog->asset/css/tab.css" rel="stylesheet">
  <script src="$blog->asset/js/tab.js" type="module"></script>
  <script src="$blog->asset/js/upload.js" type="module"></script>
  <script src="$blog->asset/js/setForm.js" type="module"></script>
  <script src="$blog->asset/js/preview.js" type="module"></script>
  <script src="$blog->asset/js/entry_delete.js" type="module"></script>
</head>
<body>


<form class="tab" action="?action=entry_update" method="POST" data-json='$json' id="entry_create_form">
<input type="submit" value="投稿する" form="entry_create_form">

<ul>
  <li class="tab-selected">編集</li>
  <li>プレビュー</li>
  <li>設定</li>
  <li>履歴</li>
  <li>削除</li>
</ul>

<section id="tab-section-form" class="tab-selected">
  <div><label>タイトル</label><input type="text" name="title" required></div>
  <div><label>カテゴリ</label><input type="text" name="category"></div>
  <textarea name="body" data-upload="?action=upload" spellcheck="false" required></textarea>
  <input type="hidden" name="id">
</section>

<section id="tab-section-preview">
  <iframe src="$blog->asset/preview.html" frameborder="0"></iframe>
</section>

<section id="tab-section-setting">
  <table>
  <tr>
    <th>記事の公開</th>
    <td><select name="status" required><option value="open">公開する</option><option value="close">非公開にする</option></select></td>
  </tr>
  </table>
</section>

<section id="tab-section-history">
</section>

<section id="tab-section-delete">
  <input type="submit" form="entry_delete_form" value="記事を削除する">
</section>


</form>


<form action="?action=entry_delete" method="POST" id="entry_delete_form">
  <input type="hidden" name="id" value="$id">
</form>



</body>
</html>
END;