<?php

$blog->login_check();

$title = request::post('title');
$title = str_replace(["\r","\n"], '', $title);

$category = request::post('category');
$category = trim($category);
$category = preg_split("/[\s\t　]+/u", $category);

if(str::match_extra($category)){
    $blog->error('カテゴリ名に半角記号は使えません');
}


$id = $db('blog')->insert([
    'title'       => $title,
    'category'    => json_encode($category, JSON_UNESCAPED_UNICODE),
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
