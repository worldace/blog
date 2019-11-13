<?php

$id    = (int)request::get('id');
$entry = $db->select($id);

if(!$entry){
    $blog->error('記事が見つかりません');
}

//PV +1
$db->query("update blog set pageview = pageview + 1 where id = $id");


$entry->title       = html::e($entry->title);
$entry->create_time = date('Y年m月d日', $entry->create_time);
$entry->category    = str::shift($entry->category, "\n");
$entry->category    = $entry->category ? str::f('<a href="%s?action=category&category=%u">%h</a>', $blog->home, $entry->category, $entry->category) : 'カテゴリなし';


$comment_thread = '';
foreach($db('comment')->query("select * from comment where entry_id = $id") as $i => $v){
    $i++;
    $v->name = html::e($v->name);
    $v->body = html::e($v->body);
    $v->body = nl2br($v->body, false);
    $v->time = date('Y/m/d H:i', $v->time);

    $comment_thread .= <<<END
      <article id="comment-$v->id" data-id="$v->id">
        <header>
          <a class="comment-no" href="$blog->home?action=comment&id=$id&comment_id=$v->id" target="_blank">$i</a>
          <span class="comment-name">$v->name</span>
          <time class="comment-time">$v->time</time>
          <span class="comment-delete"></span>
        </header>
        <p>$v->body</p>
      </article>
    END;
}


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
  <style></style>
</head>
<body>


<header>
  <h1><a href="$blog->home">$blog->title</a></h1>
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
  $comment_thread
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
