<?php

$category = [];
$li       = '';


foreach($db->query('select category from blog') as $v){
    if($v->category === ''){
        continue;
    }
    foreach(explode("\n", $v->category) as $v){
        $category[$v] = isset($category[$v]) ? $category[$v]+1 : 1;
    }
}
arsort($category);


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
