<?php

$id    = (int)request::get('id');
$entry = $db->select($id);

if(!$entry){
    $blog->error('記事が見つかりません');
}

//PV +1
$db->query("update blog set pageview = pageview + 1 where id = $id");



print new template(<<<END
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>$blog->title</title>
  <link rel="alternate" type="application/atom+xml" href="$blog->home?action=feed">
  <link rel="canonical" href="$blog->home?action=entry&id=$id">
  <link rel="stylesheet" href="$blog->asset/css/entry.css">
  <link rel="stylesheet" href="$blog->asset/css/comment.css">
  <style>
</style>
</head>
<body>


<header>
  <h1>$blog->title</h1>
</header>


<article class="article" id="article-$id">
  <header>
  <h1><a href="$blog->home?action=entry&id=$id">$entry->title</a></h1>
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


<aside class="comment" id="comment">
<form action="$blog->home?action=comment_create" method="POST">
<div><label>名前</label><input type="text" name="name" value=""></div>
<textarea name="body"></textarea>
<input type="submit" value="コメントする">
<input type="hidden" name="id" value="$id">
</form>

</aside>
</body>
</html>
END);