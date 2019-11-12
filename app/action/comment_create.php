<?php

$id    = (int)request::post('id');
$name  = request::post('name');
$body  = request::post('body');
$entry = $db->select($id);
$time  = request::time();


if(mb_strlen($name) > 30){
    $blog->error('名前が大きすぎます');
}
if(mb_strlen($body) > 1500){
    $blog->error('本文が大きすぎます');
}
if(is::empty($body)){
    $blog->error('本文がありません');
}
if(!$entry){
    $blog->error('記事が見つかりません');
}


$comment_id = $db('comment')->insert([
    'entry_id' => $id,
    'name'     => $name,
    'body'     => $body,
    'time'     => $time,
    'ip'       => $_SERVER['REMOTE_HOST'] ?? gethostbyaddr($_SERVER['REMOTE_ADDR']),
]);

$db('blog')->query("update blog set comment_count = comment_count + 1, comment_time = $time where id = $id");


$blog->set_cookie('name', $name);
response::redirect("$blog->home?action=entry&id=$id#comment-$comment_id");

