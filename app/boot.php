<?php

$dir = __DIR__;


doc::$dir = "$dir/doc/";
php::autoload($dir);

$blog = new blog;
$db   = new db("$dir/blog.db", 'blog');

$blog->action = request::get('action') ?? 'index';

if(!file_exists("$dir/blog.db")){
    include "$dir/install.php";
}