<?php

$blog->login_check();

$id = (int)request::get('id');

$entry = $db->select($id);
if($entry->category){
    $entry->category = json_decode($entry->category);
    $entry->category = implode(" ", $entry->category);
}

$json = json_encode($entry, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);


$history = '';
foreach($db('history')->query("select * from history where entry_id = $id order by id asc") as $i => $v){
    $history = sprintf('<label><input type="radio" name="_" data-id="%s"><span>%s 第%s版</span></label>', $v->id, date('Y/m/d H:i', $v->time), $i+1) . $history;
}


print <<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>編集</title>
  <link rel="stylesheet" href="$blog->asset/css/tab.css">
  <link rel="stylesheet" href="$blog->asset/css/entry_create_form.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
  <script src="$blog->asset/js/tab.js" type="module"></script>
  <script src="$blog->asset/js/upload.js" type="module"></script>
  <script src="$blog->asset/js/preview.js" type="module"></script>
  <script src="$blog->asset/js/history.js" type="module"></script>
  <script src="$blog->asset/js/entry_delete.js" type="module"></script>
  <script src="$blog->asset/js/eyecatch.js" type="module"></script>
  <script src="$blog->asset/js/setForm.js" type="module"></script>
</head>
<body>


<form class="tab" action="?action=entry_update" method="POST" data-json='$json'>

<ul class="tab-bar">
  <li class="tab-selected">編集</li>
  <li>プレビュー</li>
  <li>設定</li>
  <li>履歴</li>
  <!-- <li>削除</li> -->
</ul>

<section id="editor" class="tab-selected">
  <div><label>タイトル</label><input type="text" name="title" required></div>
  <div><label>カテゴリ</label><input type="text" name="category"></div>
  <textarea name="body" data-upload="?action=upload" spellcheck="false" required autofocus></textarea>
  <input type="hidden" name="id">
  <input type="hidden" name="eyecatch">
</section>

<section id="preview">
  <iframe src="$blog->asset/preview.html"></iframe>
</section>

<section id="setting">
  <table>
  <tr>
    <th>記事の公開</th>
    <td>
      <select name="status" required>
        <option value="open">公開する</option>
        <option value="close">非公開にする</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>アップロード</th>
    <td>png jpeg jpg gifファイルに対応 <a href="?action=upload_yearly" target="_blank"><img src="$blog->asset/img/date.png" width="16" height="16" title="アップロードリスト"></a></td>
  </tr>
  <tr>
    <th>記事のURL</th>
    <td><a href="$blog->home?action=entry&id=$id" target="_blank">$blog->home?action=entry&id=$id</a></td>
  </tr>
  </table>
</section>

<section id="history">
  <div id="history-select">
    <button type="button">復元する</button>
    $history
  </div>
  <iframe src="$blog->asset/preview.html"></iframe>
</section>

<section id="delete">
  <input type="submit" form="delete_form" value="記事を削除する">
</section>

<input id="submit" type="submit" value="更新する">

</form>


<form action="?action=entry_delete" method="POST" id="delete_form">
  <input type="hidden" name="id" value="$id">
</form>



</body>
</html>
END;