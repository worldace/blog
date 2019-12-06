<?php

$page = request::get('page', 1);

if(!is::int($page, 1)){
    $blog->error('ページ番号が不正です');
}


$data = $db->select($blog->per_page*($page-1), $blog->per_page+1);

$next = (count($data) > $blog->per_page) ? array_pop($data) : false;
$href = '?page=';


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>$blog->title</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/index.css">
  <link rel="alternate" type="application/atom+xml" href="$blog->home?action=feed">
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
