<?php


$title = request::post('title');
$title = str_replace(["\r","\n"], '', $title);

$category  = request::post('category');
$category  = str_replace(["\r","\n"], '', $category);
$category  = trim($category);
$category  = preg_split("/[\s\t　]+/u", $category);
$category  = array_unique($category);
$category  = implode("\n", $category);
$category .= "\n";


$db = $blog->db();

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


//response::redirect("$blog->home?action=entry&id=$id");
