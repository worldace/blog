<?php

$blog->this_id = (int)request::get('id');


$entry = $db->select($blog->this_id);

if(!$entry){
    $blog->error('記事が見つかりません');
}

if($entry->status !== 'open'){
    if(!$blog->is_admin){
        $blog->error('この記事は非公開です');
    }
    $entry->title = "[非公開] $entry->title";
}


$entry->title       = html::e($entry->title);
$entry->create_time = date('Y年m月d日', $entry->create_time);
$entry->category    = $entry->category ? json_decode($entry->category, true)[0] : '';
$entry->category    = $entry->category ? str::f('<a href="?action=category&category=%u">%h</a>', $entry->category, $entry->category) : 'カテゴリなし';
$entry->pageview   += 1;


//PV +1
$db->query("update blog set pageview = pageview + 1 where id = $blog->this_id");

$blog->this_comment = $db('comment')->query("select * from comment where entry_id = $blog->this_id");
$blog->this_update  = $blog->is_admin ? "<a href='?action=entry_update_form&id=$blog->this_id'>編集</a>" : '';


print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>$entry->title</title>
  <link rel="canonical" href="$blog->home?action=entry&id=$blog->this_id">
  <link rel="stylesheet" href="$blog->asset/css/base-blog.css">
  <link rel="stylesheet" href="$blog->asset/css/entry.css">
  <link rel="alternate" type="application/atom+xml" href="?action=feed">
  <link rel="icon" type="image/png" href="$blog->asset/img/favicon.png">
</head>
<body>


{{header.php}}

{{menu.php}}

<article class="entry" id="article-$blog->this_id">
  <header>
  <h1><a href="?action=entry&id=$blog->this_id">$entry->title</a></h1>
  <ul>
    <li class="entry-date">$entry->create_time</li>
    <li class="entry-category">$entry->category</li>
    <li class="entry-author">$blog->admin</li>
    <li class="entry-update">$blog->this_update</li>
    <li class="entry-pageview">$entry->pageview</li>
    <li class="entry-comment"><a href="#comment">コメント</a> $entry->comment_count</li>
  </ul>
  </header>
  <div class="entry-body">
    $entry->body
  </div>
</article>


{{comment.php}}


</body>
</html>
END);


