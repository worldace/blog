<?php

$dir = __DIR__;


php::autoload($dir);
doc::$dir = "$dir/doc/";

$blog = new blog;

if(!file_exists("$dir/blog.db")){
    require "$dir/install.php";
}