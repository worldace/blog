<?php

$blog->this_page     = is::int(request::get('page'), 1) ? request::get('page') : 1;
$blog->this_category = request::get('category');

if(str::match_extra($blog->this_category)){
    $blog->error('カテゴリ名に半角記号は使えません');
}

$blog->this_data = $db->query("select * from blog where (status = '公開' and category like ?) order by id desc 
                               limit $blog->index_count*($blog->this_page-1), $blog->index_count+1", ["%\"$blog->this_category\"%"])->fetchAll();

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
  <title>{$blog->this_category}カテゴリ</title>
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
</head>
<body>
{{header.php}}

{{menu.php}}


{{index.php}}

{{paging.php}}

</body>
</html>
END);

