<?php

$blog->login_check();

$id       = (int)request::post('id');
$title    = request::post('title');
$title    = str_replace(["\r","\n"], '', $title);
$category = request::post('category');
$category = $blog->encode_category($category);


$db('blog')->update($id, [
    'title'       => $title,
    'category'    => $category,
    'body'        => request::post('body'),
    'update_time' => request::time(),
    'status'      => request::post('status'),
    'eyecatch'    => request::post('eyecatch'),
]);

$db('history')->insert([
    'entry_id'    => $id,
    'time'        => request::time(),
    'body'        => request::post('body'),
]);

response::redirect("?action=entry&id=$id");