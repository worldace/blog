<?php


$blog->this_page  = is::int(request::get('page'), 1) ? request::get('page') : 1;
$blog->this_data  = $db->query("select * from blog where status = '公開' order by id desc limit $blog->index_count*($blog->this_page-1), $blog->index_count+1")->fetchAll();
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
  <title>$blog->title</title>
  <link rel="stylesheet" href="$blog->asset/css/index.css">
  <link rel="alternate" type="application/atom+xml" href="$blog->home?action=feed">
</head>
<body>
{{header.php}}

{{menu.php}}


{{index.php}}

{{paging.php}}

</body>
</html>
END);
