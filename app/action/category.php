<?php

$page     = request::get('page', 1);
$category = request::get('category');


if(!is::int($page, 1)){
    $blog->error('ページ番号が不正です');
}
if(str::match_extra($category)){
    $blog->error('カテゴリ名に半角記号は使えません');
}

$data = $db->search(sprintf('"%s"', $category), 'category', $blog->per_page*($page-1), $blog->per_page+1);
$next = (count($data) > $blog->per_page) ? array_pop($data) : false;
$href = str::f('?action=category&category=%u&page=', $category);


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>{$category}カテゴリ</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>
{{header.php}}

{{menu.php}}


{{index.php}}

{{paging.php}}

</body>
</html>
END, [
    'index.php'  => compact('data'),
    'paging.php' => compact('page', 'next', 'href'),
]);

