<?php

$page = request::get('page', 1);
$word = request::get('word');


if(!is::int($page, 1)){
    $blog->error('ページ番号が不正です');
}
if(is::empty($word)){
    $blog->error('検索ワードを入力してください');
}


$data = $db->search($word, ['title','body'], $blog->per_page*($page-1), $blog->per_page+1);

$next = (count($data) > $blog->per_page) ? array_pop($data) : false;
$href = str::f('?action=search&word=%u&page=', $word);


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>{{word}}の検索結果</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/search_form.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>
{{header.php}}

{{menu.php}}

<form action="./" method="GET">
  <input type="hidden" name="action" value="search">
  <input type="input" name="word" value="{{word}}" required>
  <input type="submit" value="検索する">
</form>

<div class="result"><span class="info-green">{{result}}</span></div>

{{index.php}}

{{paging.php}}

</body>
</html>
END, [
    'word'       => $word,
    'result'     => count($data) ? "$word の検索結果" : "$word は見つかりませんでした",
    'index.php'  => compact('data'),
    'paging.php' => compact('page', 'next', 'href'),
]);