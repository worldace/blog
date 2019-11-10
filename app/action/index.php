<?php

$html = new doc(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>$blog->title</title>
  <link href="$blog->asset/css/index.css" rel="stylesheet">
  <link rel="alternate" type="application/atom+xml" href="$blog->home?action=feed">
</head>
<body>

<doc-index></doc-index>



</body>
</html>
END);

$page = $blog->page();

$html->index_data = $db->query("select * from 'blog' where status = '公開' order by 'id' desc limit $blog->index_count*($page-1), $blog->index_count+1")->fetchAll();


print $html;