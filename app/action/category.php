<?php

$blog->this_page     = request::get('page', 1);
$blog->this_category = request::get('category');


if(!is::int($blog->this_page, 1)){
    $blog->error('ページ番号が不正です');
}
if(str::match_extra($blog->this_category)){
    $blog->error('カテゴリ名に半角記号は使えません');
}

$blog->this_data = $db->search(sprintf('"%s"', $blog->this_category), 'category', $blog->index_count*($blog->this_page-1), $blog->index_count+1);

$blog->this_paging_next = (count($blog->this_data) > $blog->index_count) ? array_pop($blog->this_data) : false;
$blog->this_paging_url  = str::f('?action=category&category=%u&page=', $blog->this_category);


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>{$blog->this_category}カテゴリ</title>
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
END);

