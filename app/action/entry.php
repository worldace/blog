<?php

$blog->this_id = (int)request::get('id');


$entry = $db->select($blog->this_id);
if(!$entry){
    $blog->error('記事が見つかりません');
}

$entry->title       = html::e($entry->title);
$entry->create_time = date('Y年m月d日', $entry->create_time);
$entry->category    = $entry->category ? json_decode($entry->category, true)[0] : '';
$entry->category    = $entry->category ? str::f('<a href="?action=category&category=%u">%h</a>', $entry->category, $entry->category) : 'カテゴリなし';
$entry->pageview   += 1;


//PV +1
$db->query("update blog set pageview = pageview + 1 where id = $blog->this_id");

$blog->this_comment = $db('comment')->query("select * from comment where entry_id = $blog->this_id");


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>$entry->title</title>
  <link rel="alternate" type="application/atom+xml" href="?action=feed">
  <link rel="canonical" href="$blog->home?action=entry&id=$blog->this_id">
  <link rel="stylesheet" href="$blog->asset/css/entry.css">
</head>
<body>


{{header.php}}

{{menu.php}}

<article class="article" id="article-$blog->this_id">
  <header>
  <h1><a href="?action=entry&id=$blog->this_id">$entry->title</a></h1>
  <ul>
    <li class="article-date">$entry->create_time</li>
    <li class="article-category">$entry->category</li>
    <li class="article-author">$blog->admin</li>
    <li class="article-pageview">$entry->pageview</li>
    <li class="article-comment"><a href="#comment">コメント</a> $entry->comment_count</li>
  </ul>
  </header>
  <div class="contents">
    $entry->body
  </div>
</article>


{{comment.php}}


</body>
</html>
END);


