<?php

$id = (int)request::get('id');


$entry = $db->select($id);

if(!$entry){
    $blog->error('記事が見つかりません');
}
if($entry->status !== 'open' and !$blog->is_admin){
    $blog->error('この記事は非公開です');
}

$entry->create_time = date('Y年m月d日', $entry->create_time);
$entry->category    = json_decode($entry->category)[0];
$entry->category    = $entry->category ? str::f('<a href="?action=category&category=%u">%h</a>', $entry->category, $entry->category) : 'カテゴリなし';
$entry->pageview   += 1;


$db->query("update blog set pageview = pageview + 1 where id = $id");

$comment = $db('comment')->query("select * from comment where entry_id = $id");


print new template(<<<END
<!DOCTYPE html>
<html lang="ja" data-admin="$blog->is_admin" data-status="$entry->status">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta property="og:url" content="$blog->home?action=entry&id=$id">
  <meta property="og:title" content="{{title}}">
  <meta property="og:type" content="article">
  <meta property="og:image" content="$entry->eyecatch">
  <title>{{title}}</title>
  <link rel="canonical" href="$blog->home?action=entry&id=$id">
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/entry.css">
  <link rel="stylesheet" href="$blog->asset/css/entry-body.css">
  <link rel="alternate" type="application/atom+xml" href="?action=feed">
  <link rel="icon" href="$blog->asset/img/favicon.png" type="image/png">
</head>
<body>


{{header.php}}

{{menu.php}}

<article class="entry">
  <header class="entry-header">
  <h1 class="entry-title"><a href="?action=entry&id=$id">{{title}}</a></h1>
  <ul class="entry-info">
    <li class="entry-date">$entry->create_time</li>
    <li class="entry-category">$entry->category</li>
    <li class="entry-author">$blog->admin</li>
    <li class="entry-update"><a href="?action=entry_update_form&id=$id">編集</a></li>
    <li class="entry-pageview">$entry->pageview</li>
    <li class="entry-comment"><a href="#comment">コメント</a> $entry->comment_count</li>
  </ul>
  </header>
  <article class="entry-body">
    $entry->body
  </article>
</article>

{{socialbutton.php}}

{{comment.php}}


</body>
</html>
END, [
    'title' => $entry->title,
    'socialbutton.php' => $entry,
    'comment.php' => compact('id', 'comment'),
]);


