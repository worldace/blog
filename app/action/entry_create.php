<?php

$blog->login_check();

$title = request::post('title');
$title = str_replace(["\r","\n"], '', $title);

$category = $blog->encode_category(request::post('category'));


$id = $db('blog')->insert([
    'title'       => $title,
    'category'    => $category,
    'body'        => request::post('body'),
    'create_time' => request::time(),
    'status'      => request::post('status'),
]);

$db('history')->insert([
    'entry_id'    => $id,
    'time'        => request::time(),
    'body'        => request::post('body'),
]);


response::redirect("$blog->home?action=entry&id=$id");
