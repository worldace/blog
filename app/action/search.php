<?php

$word            = request::get('word');
$blog->this_page = request::get('page') ?? 1;


if(is::empty($word)){
    $blog->error('検索ワードを入力してください');
}
if(!is::int($blog->this_page, 1)){
    $blog->error('ページ番号が不正です');
}


$blog->this_data  = $db->search($word, ['title','body'], $blog->index_count*($blog->this_page-1), $blog->index_count+1, 'status = "open"');
$blog->this_count = count($blog->this_data);

if($blog->this_count > $blog->index_count){
    array_pop($blog->this_data);
}



print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>{{word}}の検索結果</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/search_form.css">
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
    'word'   => $word,
    'result' => $blog->this_count ? "$word の検索結果" : "$word は見つかりませんでした",
]);