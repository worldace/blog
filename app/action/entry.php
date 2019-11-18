<?php

$blog->id = (int)request::get('id');
$entry    = $db->select($blog->id);

if(!$entry){
    $blog->error('記事が見つかりません');
}

//PV +1
$db->query("update blog set pageview = pageview + 1 where id = $blog->id");


$entry->title       = html::e($entry->title);
$entry->create_time = date('Y年m月d日', $entry->create_time);
$entry->category    = str::shift($entry->category, "\n");
$entry->category    = $entry->category ? str::f('<a href="%s?action=category&category=%u">%h</a>', $blog->home, $entry->category, $entry->category) : 'カテゴリなし';



print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>$blog->title</title>
  <link rel="alternate" type="application/atom+xml" href="$blog->home?action=feed">
  <link rel="canonical" href="$blog->home?action=entry&id=$blog->id">
  <link rel="stylesheet" href="$blog->asset/css/entry.css">
</head>
<body>


{{header.php}}

{{menu.php}}

<article class="article" id="article-$blog->id">
  <header>
  <h1><a href="$blog->home?action=entry&id=$blog->id">$entry->title</a></h1>
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
