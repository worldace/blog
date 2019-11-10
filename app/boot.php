<?php

$dir = __DIR__;


php::autoload($dir);
doc::$dir = "$dir/doc/";

$blog = new blog;

$blog->action = request::get('action') ?? 'index';

if(!file_exists("$dir/blog.db")){
    require "$dir/install.php";
}