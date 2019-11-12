<?php

$id = is::int(request::get('id'), 1) ? request::get('id') : $blog->error('不正なIDです');
$entry = $db->select($id) ?: $blog->error('記事が見つかりません');

//PVアップ
$db->query("update blog set pageview = pageview + 1 where id = $id");

var_dump($entry);
