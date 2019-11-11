<?php

$dir = __DIR__;


doc::$dir = "$dir/doc/";
php::autoload($dir);


$blog = new blog;
$blog->action = request::get('action') ?? 'index';


if(!file_exists("$dir/data/blog.db")){
    include "$dir/install.php";
}
$db = new db("$dir/data/blog.db", 'blog');
