<?php

$category = [];
foreach($db->query('select category from blog') as $v){
    if(!$v->category){
        continue;
    }
    foreach(json_decode($v->category, true) as $v){
        $category[$v] = isset($category[$v]) ? $category[$v]+1 : 1;
    }
}
arsort($category);


$li = '';
foreach($category as $name => $count){
    $li .= str::f('<li><a href="?action=category&category=%u" data-count="%s">%h</a></li>%n', $name, $count, $name);
}



print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>カテゴリリスト</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/category_list.css">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>


{{header.php}}

{{menu.php}}

<ul class="tagcloud">
$li
</li>


</body>
</html>
END);
